<?php

namespace App\Controllers;

use Jenssegers\Date\Date;
use GuzzleHttp\Client;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TiketModel;
use App\Models\KapalModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\KendaraanModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class PaymentController extends BaseController
{

    public function showOrderInfo()
    {
        $kendaraanModel = new KendaraanModel();
        $kapalModel = new KapalModel();
        $jamModel = new JamModel();
        $lokasiModel = new LokasiModel();
        $tiketModel = new TiketModel();
        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->getTransactionsWithSnapToken();
        $auth = service('authentication');
        $isLoggedIn = $auth->check();

        if ($isLoggedIn) {
            $user = $auth->user();
            $userId = $user->id;
        } else {
            return redirect()->to('/login');
        }

        $orderInfos = [];
        $hasTransaction = false; // Menandakan apakah pengguna memiliki transaksi atau tidak

        foreach ($transactions as $transaction) {
            $transactionUserId = $transaction['users'];

            if ($transaction) {
                $id_tiket = $transaction['id_tiket'];
                $id_kendaraan = $transaction['kouta_kendaraan'];

                $tiket = $tiketModel->find($id_tiket);
                $jenisKendaraan = $kendaraanModel->getJenis($id_kendaraan);

                if ($userId && $transactionUserId === $userId) {
                    $orderInfo = $this->getOrderInfo($transaction['snap_token']);

                    if ($tiket) {
                        $orderInfo['asal'] = $lokasiModel->getAsal($tiket['asal']);
                        $orderInfo['tujuan'] = $lokasiModel->getTujuan($tiket['tujuan']);
                        $orderInfo['keberangkatan'] = $jamModel->getJamKeberangkatan($tiket['keberangkatan']);
                        $orderInfo['tiba'] = $jamModel->getJamTiba($tiket['tiba']);
                        $orderInfo['kapal'] = $kapalModel->getKapalName($tiket['kapal']);
                        $orderInfo['kelas'] = $transaction['kelas'];
                        $orderInfo['nama_lengkap'] = $this->formatCustomerNames($transaction['nama_lengkap']);
                        $orderInfo['kouta_penumpang'] = $transaction['kouta_penumpang'];
                        $orderInfo['kouta_kendaraan'] = $jenisKendaraan;
                        $orderInfo['tanggal'] = $tiketModel->getTanggalFormatted($tiket['tanggal']);

                        $orderInfos[] = $orderInfo;
                        $hasTransaction = true; // Setel nilai ke true karena pengguna memiliki transaksi
                    }
                }
            }
        }

        if (!$hasTransaction) {
            // Jika pengguna tidak memiliki transaksi, redirect ke halaman "/tiket"
            return redirect()->to('/tiket');
        }

        // Update transaction status
        $this->updateTransactionStatus($transactionModel, $tiketModel);

        return view('tiket/tiket_saya', [
            'orderInfos' => $orderInfos,
        ]);
    }

    public function getOrderInfo($snapToken)
    {
        $client = new Client();
        $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions/' . $snapToken . '/status';

        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3:')
            ]
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $body = $response->getBody()->getContents();
            $orderInfo = json_decode($body, true);

            return $orderInfo;
        } else {
            // Handle responses other than status code 200 as needed
            return null;
        }
    }
    public function updateTransactionStatus(TransactionModel $transactionModel, TiketModel $tiketModel)
    {
        $transactions = $transactionModel->findAll();
        $tiketModel = new TiketModel();
        $jamModel = new JamModel();
        $client = new Client();

        foreach ($transactions as $transaction) {
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions/' . $transaction['snap_token'] . '/status';

            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3:')
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $orderInfo = json_decode($body, true);

                // Update transaction status in the transaction table
                if ($transaction['transaction_status'] !== $orderInfo['transaction_status']) {
                    $transactionModel->update($transaction['order_id'], ['transaction_status' => $orderInfo['transaction_status']]);

                    // Delete the transaction if kouta_kendaraan or kouta_penumpang in transaction is greater than kouta_kendaraan or kouta_penumpang in tiket, and status is 'pending'
                    if ($orderInfo['transaction_status'] == 'pending' && ($transaction['kouta_kendaraan'] > $transaction['kouta_kendaraan'] || $transaction['kouta_penumpang'] > $transaction['kouta_penumpang'])) {
                        $transactionModel->delete($transaction['order_id']);
                    }

                    // Update kouta_kendaraan and kouta_penumpang in the tiket table
                    if ($orderInfo['transaction_status'] == 'settlement') {
                        $id_tiket = $transaction['id_tiket'];
                        $koutaKendaraan = $transaction['kouta_kendaraan'];
                        $koutaPenumpang = $transaction['kouta_penumpang'];

                        $tiketModel->decrementKoutaKendaraan($id_tiket, $koutaKendaraan);
                        $tiketModel->decrementKoutaPenumpang($id_tiket, $koutaPenumpang);

                        // Generate and store new barcode image
                        $writer = new PngWriter();

                        // Get the order ID from the transaction
                        $orderId = $transaction['order_id'];

                        // Create QR code URL with the order ID
                        $qrCodeUrl = 'http://localhost:8081/print/' . $orderId;

                        // Create QR code
                        $qrCode = QrCode::create($qrCodeUrl)
                            ->setEncoding(new Encoding('UTF-8'))
                            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                            ->setSize(300)
                            ->setMargin(10)
                            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                            ->setForegroundColor(new Color(0, 0, 0))
                            ->setBackgroundColor(new Color(255, 255, 255));

                        // Create generic logo
                        $logo = Logo::create(FCPATH . '/img/icon/logo.png')
                            ->setResizeToWidth(50)
                            ->setPunchoutBackground(true);

                        $result = $writer->write($qrCode, $logo);

                        $result->saveToFile(FCPATH . 'barcode/' . $orderId . '.png');

                        // Update the transaction table with the barcode image name
                        $transactionModel->update($orderId, ['barcode' => $orderId . '.png']);
                    }
                }
            }
        }

        // Delete transactions that have exceeded the kouta_kendaraan or kouta_penumpang in tiket when the page is refreshed
        $pendingTransactions = $transactionModel->where('transaction_status', 'pending')->findAll();
        foreach ($pendingTransactions as $transaction) {
            $tiket = $tiketModel->find($transaction['id_tiket']);
            if ($tiket) {
                $jamKeberangkatan = $jamModel->find($tiket['keberangkatan']);
                $tanggalJamKeberangkatan = $tiket['tanggal'] . ' ' . $jamKeberangkatan['keberangkatan'];

                $now = date('Y-m-d H:i:s');
                if ($tanggalJamKeberangkatan < $now) {
                    $transactionModel->delete($transaction['order_id']);
                }
                if ($transaction['kouta_kendaraan'] > $tiket['kouta_kendaraan'] || $transaction['kouta_penumpang'] > $tiket['kouta_penumpang']) {
                    $transactionModel->delete($transaction['order_id']);
                }
            } else {
                $transactionModel->delete($transaction['order_id']);
            }
        }

        // Delete transactions with transaction_status = 'expire'
        $expireTransactions = $transactionModel->where('transaction_status', 'expire')->findAll();
        foreach ($expireTransactions as $transaction) {
            $transactionModel->delete($transaction['order_id']);
        }


        return redirect()->back()->with('success', 'Transaction status updated successfully.');
    }


    public function detailPesanan()
    {
        $orderId = $this->request->getPost('order_id'); // Ambil order ID dari input form

        // Simpan order ID dalam flash data
        session()->setFlashdata('order_id', $orderId);

        // Redirect ke halaman detail pesanan
        return redirect()->to("tiket/detail-tiket");
    }

    public function showOrderDetails()
    {
        $orderModel = new TransactionModel();
        $kendaraanModel = new KendaraanModel();
        $tiketModel = new TiketModel();
        $kapalModel = new KapalModel();
        $lokasiModel = new LokasiModel();
        $jamModel = new JamModel();

        // Ambil order ID dari flash data
        $orderId = session()->getFlashdata('order_id');

        // Validasi order ID
        if (!$orderId) {
            // Jika order ID tidak ada, arahkan ke halaman /tiket_saya
            return redirect()->to("tiket/tiket-saya");
        }

        // Ambil data pesanan berdasarkan order ID
        $order = $orderModel->find($orderId);

        if ($order) {
            $id_tiket = $order['id_tiket'];
            $tiket = $tiketModel->find($id_tiket);

            $id_kendaraan = $order['kouta_kendaraan'];
            $jenisKendaraan = $kendaraanModel->getJenis($id_kendaraan);

            $order['kouta_kendaraan'] = $jenisKendaraan;

            if ($tiket) {
                $order['asal'] = $tiket['asal'];
                $order['tujuan'] = $tiket['tujuan'];
                $order['keberangkatan'] = $tiket['keberangkatan'];
                $order['tiba'] = $tiket['tiba'];
                $order['kapal'] = $kapalModel->getKapalName($tiket['kapal']);
                $order['kelas'] = $order['kelas'];
                $order['nama_lengkap'] = $this->formatCustomerNames($order['nama_lengkap']);
                $order['kouta_penumpang'] = $order['kouta_penumpang'];
                $order['kouta_kendaraan'] = $jenisKendaraan;
                $order['tanggal'] = $tiketModel->getTanggalFormatted($tiket['tanggal']);
                $order['asal'] = $lokasiModel->getAsal($tiket['asal']);
                $order['tujuan'] = $lokasiModel->getTujuan($tiket['tujuan']);
                $order['keberangkatan'] = $jamModel->getJamKeberangkatan($tiket['keberangkatan']);
                $order['tiba'] = $jamModel->getJamTiba($tiket['tiba']);
                $order['tanggal'] = $tiketModel->getTanggalFormatted($tiket['tanggal']);
                $order['barcode'] = $order['barcode'];
            }

            // Get the expiry time from Midtrans
            $client = new Client();
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions/' . $order['snap_token'] . '/status';

            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3:')
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $orderInfo = json_decode($body, true);

                // Get the expiry time from the response
                $expiryTime = $orderInfo['expiry_time'];
                Date::setLocale('id'); // Atur bahasa ke Indonesia
                $formattedExpiryTime = Date::parse($expiryTime)->format('l, d F Y, H:i');

                // Pass the formatted expiry time to the view
                return view('tiket/detail_pesanan', ['order' => $order, 'formattedExpiryTime' => $formattedExpiryTime]);
            }
        }
    }



    private function formatCustomerNames($names)
    {
        $customerNames = explode(',', $names);
        $formattedNames = [];

        foreach ($customerNames as $key => $name) {
            $formattedNames[] =  ($key + 1) . '. ' . trim($name);
        }

        return implode('<br>', $formattedNames);
    }
}

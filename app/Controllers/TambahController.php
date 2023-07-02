<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\TransactionModel;

class TambahController extends BaseController
{


    public function index()
    {
        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        // Get the currently logged-in user

        $params = [
            'transaction_details' => [
                'order_id' => 'BKS-' . rand(),
                'gross_amount' => 10000,
            ],
        ];

        $data = [
            'snapToken' => Snap::getSnapToken($params),
        ];

        return view('tiket/detail_tiket', $data);
    }

    public function tambahPaymentResult()
    {
        // Mengambil data hasil pembayaran dari POST request
        $result = json_decode($this->request->getBody(), true);

        // Mengecek apakah kunci 'status_code' ada dalam $result
        if (isset($result['status_code'])) {
            // Mendapatkan snap_token dari pdf_url
            $snapToken = $this->getSnapTokenFromPdfUrl($result['pdf_url']);
            $result['snap_token'] = $snapToken;

            // Model dan proses penyimpanan ke tabel transaksi
            $transactionModel = new TransactionModel();
            $transactionModel->insert($result);
        } else {
            // Tampilkan pesan error jika kunci 'status_code' tidak ditemukan
            return "Error: Invalid payment result data";
        }
    }

    protected function getSnapTokenFromPdfUrl($pdfUrl)
    {
        // Mengambil snap_token dari pdf_url
        $snapToken = str_replace('/pdf', '', $pdfUrl);
        $snapToken = str_replace('https://app.sandbox.midtrans.com/snap/v1/transactions/', '', $snapToken);

        return $snapToken;
    }
    public function updatePayment()
    {
        // Retrieve the submitted data
        $koutaKendaraan = $this->request->getPost('kouta_kendaraan');
        $koutaPenumpang = $this->request->getPost('kouta_penumpang');
        $snapToken = $this->request->getPost('snap_token');
        $names = $this->request->getPost('names');
        $kelas = $this->request->getPost('kelas');
        $idTiket = $this->request->getPost('id_tiket');
        // Perform validation if necessary

        // Update the transaction data in the database or storage
        // Assuming you have a transaction model, update the relevant fields using the snap_token as the identifier
        $transactionModel = new TransactionModel();
        $transaction = $transactionModel->where('snap_token', $snapToken)->first();

        if ($transaction) {
            // Get the logged-in user's username using CodeIgniter's authentication library
            $user = $this->authenticateUser(); // Replace with your actual authentication method

            if ($user) {
                $transactionModel->update($transaction['order_id'], [
                    'id_tiket' => $idTiket,
                    'kouta_kendaraan' => $koutaKendaraan,
                    'kouta_penumpang' => $koutaPenumpang,
                    'kelas' => $kelas,
                    'users' => $user->id,
                    'nama_lengkap' => implode(', ', $names),
                ]);

                // Redirect or return a response as needed
            } else {
                // User not logged in or authentication failed
                // Handle the error accordingly
            }
        } else {
            // Transaction not found for the provided snap_token
            // Handle the error accordingly
        }
    }

    protected function authenticateUser()
    {
        // Assuming you are using Myth/Auth library for authentication
        $auth = service('authentication');

        if ($auth->check()) {
            // User is logged in
            $user = $auth->user();
            return $user;
        } else {
            // User is not logged in or authentication failed
            return null;
        }
    }
}

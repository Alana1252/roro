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

        $params = [
            'transaction_details' => [
                'order_id' => 'BKS-' . rand(),
                'gross_amount' => 10000,
            ],
        ];

        $data = [
            'snapToken' => Snap::getSnapToken($params),
        ];

        return view('tiket/payment', $data);
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
    
            // Tambahkan log atau notifikasi lainnya sesuai kebutuhan Anda
    
            return view('pages/payment_result', ['result' => $result]);
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


    
}    
<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use CodeIgniter\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->where('transaction_status', 'pending')->findAll();

        return view('transaction_list', ['transactions' => $transactions]);
    }

    public function getSnapToken()
    {
        $grossAmount = $this->request->getPost('gross_amount');

        // Lakukan langkah-langkah untuk mendapatkan snap token
        // Misalnya, melakukan request ke Midtrans API

        $snapToken = 'SNAP_TOKEN'; // Contoh snap token yang diperoleh

        $response = [
            'success' => true,
            'snap_token' => $snapToken
        ];

        return $this->response->setJSON($response);
    }

    public function handlePaymentResult($result)
    {
        // Lakukan langkah-langkah untuk menangani hasil pembayaran
        // Misalnya, memperbarui status transaksi di database

        $transactionId = $result['order_id']; // Contoh pengambilan ID transaksi dari hasil pembayaran
        $transactionModel = new TransactionModel();
        $transaction = $transactionModel->find($transactionId);

        if (!$transaction) {
            // Handle jika transaksi tidak ditemukan
            // Misalnya, tampilkan pesan error atau lakukan langkah lain yang sesuai
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Perbarui status transaksi menjadi berhasil atau lainnya sesuai dengan hasil pembayaran
        $transactionModel->update($transactionId, ['transaction_status' => $result['transaction_status']]);

        // Tampilkan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran berhasil.');
    }
}

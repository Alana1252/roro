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

    public function handlePaymentResult()
{
    // Mendapatkan data dari response pembayaran Midtrans
    $result = $_POST;

    // Cek apakah transaksi berhasil
    if ($result['transaction_status'] === 'settlement') {
        // Mendapatkan ID transaksi
        $transactionId = $result['order_id'];

        // Mengambil data transaksi berdasarkan ID
        $transactionModel = new TransactionModel();
        $transaction = $transactionModel->find($transactionId);

        // Periksa apakah transaksi ditemukan
        if (!$transaction) {
            // Handle jika transaksi tidak ditemukan
            // Misalnya, tampilkan pesan error atau lakukan langkah lain yang sesuai
            return;
        }

        // Ubah nilai kolom-kolom yang ingin diubah
        $transactionModel->set($transactionId, [
            'transaction_status' => 'completed',
            'paid_amount' => $result['gross_amount']
        ]);

        // Simpan perubahan ke dalam database
        $transactionModel->update();

        // Lakukan langkah-langkah lain yang diperlukan setelah transaksi berhasil dibayar
    }
}

    
}

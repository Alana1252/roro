<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaksi'; // Nama tabel transaksi

    protected $primaryKey = 'order_id'; // Primary key tabel

    protected $allowedFields = [
        'order_id',
        'id_tiket',
        'users',
        'nama_lengkap',
        'gross_amount',
        'payment_type',
        'payment_method',
        'transaction_time',
        'transaction_status',
        'kelas',
        'kouta_kendaraan',
        'kouta_penumpang',
        'pdf_url',
        'finish_redirect_url',
        'snap_token',
    ];

    public function insertTransaction($data)
    {
        $this->insert($data);
    }

    public function getTransactionsWithSnapToken()
    {
        return $this->where('snap_token IS NOT NULL')->findAll();
    }
    public function deleteTransaction($order_id)
    {
        return $this->where('order_id', $order_id)->delete();
    }
}

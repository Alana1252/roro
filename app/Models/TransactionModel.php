<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaksi'; // Nama tabel transaksi

    protected $primaryKey = 'order_id'; // Primary key tabel

    protected $allowedFields = [
        'order_id',
        'users',
        'gross_amount',
        'payment_type',
        'payment_method',
        'transaction_time',
        'transaction_status',
        'bca_va_number',
        'pdf_url',
        'finish_redirect_url',
        'snap_token'
    ];


    public function getTransactionsWithSnapToken()
    {
        return $this->where('snap_token IS NOT NULL')->findAll();
    }
}

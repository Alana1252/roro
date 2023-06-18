<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaksi'; // Nama tabel transaksi

    protected $primaryKey = 'id_transaksi'; // Primary key tabel

    protected $allowedFields = [
        'order_id',
        'status_message',
        'gross_amount',
        'payment_type',
        'payment_method',
        'transaction_time',
        'transaction_status',
        'fraud_status',
        'bca_va_number',
        'pdf_url',
        'finish_redirect_url',
        'snap_token'
    ];

    protected $useTimestamps = true; // Menggunakan created_at dan updated_at

    protected $createdField = 'created_at'; // Nama kolom created_at

    protected $updatedField = 'updated_at'; // Nama kolom updated_at


}

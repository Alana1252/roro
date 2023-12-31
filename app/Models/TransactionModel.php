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
        'barcode',
        'pdf_url',
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
    public function getTransactionStatusLabel($transactionStatus)
    {
        if ($transactionStatus === 'pending') {
            return 'Menunggu pembayaran';
        } elseif ($transactionStatus === 'settlement') {
            return 'Telah dibayar';
        } else {
            return $transactionStatus;
        }
    }
    public function countSuccessfulTickets($userId)
    {
        return $this->db->table('transaksi')
            ->join('users', 'transaksi.users = users.id')
            ->where('transaksi.transaction_status', 'settlement')
            ->where('users.id', $userId)
            ->countAllResults();
    }
    public function countPendingTickets($userId)
    {
        return $this->db->table('transaksi')
            ->join('users', 'transaksi.users = users.id')
            ->where('transaksi.transaction_status', 'pending')
            ->where('users.id', $userId)
            ->countAllResults();
    }

    public function jumlahPaymentBerhasil()
    {
        return $this->db->table('transaksi')
            ->where('transaction_status', 'settlement')
            ->selectSum('gross_amount')
            ->get()
            ->getRowArray();
    }
    public function jumlahPaymentPending()
    {
        return $this->db->table('transaksi')
            ->where('transaction_status', 'pending')
            ->selectSum('gross_amount')
            ->get()
            ->getRowArray();
    }
    public function jumlahPaymentAll()
    {
        return $this->db->table('transaksi')
            ->selectSum('gross_amount')
            ->get()
            ->getRowArray();
    }
    public function getpaymentBulan()
    {
        $bulanIni = date('Y-m');
        $this->where('transaction_status', 'settlement');
        $this->like('transaction_time', $bulanIni);
        $result = $this->get()->getRowArray();

        return $result;
    }

    public function getTiketBulan()
    {
        $bulanIni = date('Y-m');
        $this->where('transaction_status', 'settlement');
        $this->like('transaction_time', $bulanIni);
        $result = $this->countAllResults();

        return $result;
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TiketModel;
use CodeIgniter\I18n\Time;

class LiveController extends BaseController
{
    protected $transactionModel;
    protected $tiketModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->tiketModel = new TiketModel();
    }

    public function index()
    {
        $today = date('Y-m-d');
        $data['title'] = 'Live CCTV';

        $result = $this->transactionModel->select('transaksi.id_tiket as transkasiid, transaction_status, tiket.id_tiket as idtiket, tiket.tanggal as tikettanggal')
            ->join('tiket', 'transaksi.id_tiket = tiket.id_tiket', 'left')
            ->where('tanggal', $today)
            ->where('transaction_status', 'settlement')
            ->get()->getResult();

        // Display the result
        foreach ($result as $row) {
            echo "Transaction ID: " . $row->id_tiket . "<br>";
            // Display other columns as needed
        }

        $formattedDates = [];
        foreach ($result as $row) {
            $tanggal = new Time($row->tikettanggal);
            $formattedDates[] = $tanggal->format('l, d F Y');
        }

        return view('pages/live-cctv', ['count' => $result, 'formattedDates' => $formattedDates]);
    }
}

<?php

namespace App\Controllers;

use App\Models\News_model;
use App\Models\TransactionModel;
use Myth\Auth\Models\UserModel;

class News extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $model = new News_model();
        $userModel = new UserModel();

        // Memanggil fungsi untuk menghitung jumlah pembayaran berhasil
        $paymentBerhasil = $transactionModel->jumlahPaymentBerhasil();

        // Memanggil fungsi untuk menghitung jumlah pembayaran pending
        $paymentPending = $transactionModel->jumlahPaymentPending();

        // Memanggil fungsi untuk menghitung jumlah pembayaran keseluruhan
        $paymentAll = $transactionModel->jumlahPaymentAll();

        //Jumlah transaksi perbulan
        $paymentBulan = $transactionModel->getpaymentBulan();
        $currentMonth = date('n'); // Mendapatkan bulan saat ini (misalnya 7 untuk bulan Juli)
        $monthlyActiveUsers = $userModel
            ->where('status', 'Aktif')
            ->where("MONTH(created_at) <= $currentMonth")
            ->findAll();


        $data['news'] = $model->getLatestNews();

        $data['tiketBulan'] = $transactionModel->getTiketBulan();
        $data['transaksi'] = $transactionModel->findAll();
        $data['paymentBerhasil'] = $paymentBerhasil['gross_amount'];
        $data['paymentPending'] = $paymentPending['gross_amount'];
        $data['paymentAll'] = $paymentAll['gross_amount'];
        $data['tiketBerhasil'] = $transactionModel->where('transaction_status', 'settlement')->countAllResults();
        $data['tiketPending'] = $transactionModel->where('transaction_status', 'pending')->countAllResults();
        $data['tiketAll'] = $transactionModel->where('transaction_status', 'settlement')->countAllResults() + $transactionModel->where('transaction_status', 'pending')->countAllResults();
        $data['paymentBulan'] = $paymentBulan['gross_amount'];

        $data['userAktif'] = $userModel->where('status', 'Aktif')->countAllResults();
        $data['monthlyActiveUsers'] = $monthlyActiveUsers;



        return view('pages/home', $data);
    }
}

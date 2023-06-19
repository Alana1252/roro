<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use CodeIgniter\Controller;
use App\Models\TransactionModel;

class PaymentController extends Controller
{
    public function showOrderInfo()
    {
        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->getTransactionsWithSnapToken();

        $orderInfos = [];
        foreach ($transactions as $transaction) {
            $orderInfos[] = $this->getOrderInfo($transaction['snap_token']);
        }

        // Update transaction status
        $this->updateTransactionStatus($transactionModel);

        return view('tiket/order_info', ['orderInfos' => $orderInfos]);
    }

    public function getOrderInfo($snapToken)
    {
        $client = new Client();
        $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions/' . $snapToken . '/status';

        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3:')
            ]
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $body = $response->getBody()->getContents();
            $orderInfo = json_decode($body, true);

            return $orderInfo;
        } else {
            // Handle responses other than status code 200 as needed
            return null;
        }
    }

    public function updateTransactionStatus(TransactionModel $transactionModel)
    {
        $transactions = $transactionModel->findAll();

        $client = new Client();

        foreach ($transactions as $transaction) {
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions/' . $transaction['snap_token'] . '/status';

            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3:')
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $orderInfo = json_decode($body, true);

                // Update transaction status in the transaction table
                $transactionModel->update($transaction['order_id'], ['transaction_status' => $orderInfo['transaction_status']]);
            }
        }

        return redirect()->back()->with('success', 'Transaction status updated successfully.');
    }
}

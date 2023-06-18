<?php

namespace App\Controllers;

use App\Models\TiketModel;
use CodeIgniter\Controller;

class CronController extends Controller
{
    public function generateTiket()
    {
        // Load TiketModel
        $tiketModel = new TiketModel();

        // Set initial values
        $kapal = 1;
        $asal = 1;
        
        // Get current date
        $currentDate = date('Y-m-d');

        // Get the end date by adding 2 weeks to the current date
        $endDate = date('Y-m-d', strtotime('+2 weeks', strtotime($currentDate)));

        // Generate and insert new tiket into the database for each date
        $date = $currentDate;
        while ($date <= $endDate) {
            for ($i = 1; $i <= 28; $i++) {
                // Check if the tiket with the same tanggal and keberangkatan already exists
                $existingTiket = $tiketModel->where('tanggal', $date)
                                            ->where('keberangkatan', $i)
                                            ->first();

                // Insert new tiket if it doesn't already exist
                if (!$existingTiket) {
                    $data = [
                        'tanggal' => $date,
                        'kapal' => $kapal,
                        'keberangkatan' => $i,
                        'tiba' => $i,
                        'asal' => $asal,
                        'tujuan' => $asal,
                    ];
                    $tiketModel->insert($data);
                }

                // Increment values for next iteration
                $kapal = ($kapal % 3) + 1;
                $asal = ($asal % 2) + 1;
            }

            // Move to the next date
            $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
        }
    }
}
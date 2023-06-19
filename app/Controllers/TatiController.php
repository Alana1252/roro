<?php

namespace App\Controllers;

use App\Models\TiketModel;

class DataController extends BaseController
{
    protected $tiketModel;

    public function __construct()
    {
        $this->tiketModel = new TiketModel();
    }

    public function selectTicket()
    {
        if ($this->request->getMethod() === 'post') {
            $tiketId = $this->request->getPost('tiketId');

            // Retrieve the selected ticket from the model
            $selectedTiket = $this->tiketModel->getTiketById($tiketId);

            if ($selectedTiket) {
                // Pass the selected ticket data to the view
                $data['selectedTiket'] = $selectedTiket;

                // Load the "input_data.php" view with the selected ticket data
                return view('pages/input_data', $data);
            } else {
                return redirect()->back()->with('error', 'Tiket not found.');
            }
        } else {
            // Tampilkan pesan error jika metode yang digunakan bukan metode POST
            return redirect()->back()->with('error', 'Metode yang digunakan tidak valid.');
        }
    }
}

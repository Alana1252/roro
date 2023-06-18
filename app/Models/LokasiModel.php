<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'keberangkatan';
    protected $primaryKey = 'id_keberangkatan';
    protected $allowedFields = ['asal', 'tujuan'];

    public function getAsal($asalId)
    {
        $lokasi = $this->find($asalId);
        if ($lokasi) {
            return $lokasi['asal'];
        }
        return '';
    }

    public function getTujuan($asalId)
    {
        $lokasi = $this->find($asalId);
        if ($lokasi) {
            return $lokasi['tujuan'];
        }
        return '';
    }
}

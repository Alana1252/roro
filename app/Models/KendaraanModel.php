<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields = ['jenis', 'harga'];

    public function getHargaByJenis($jenis)
    {
        return $this->where('jenis', $jenis)->first()['harga'] ?? null;
    }

    public function getHargaById($id)
    {
        return $this->find($id)['harga'] ?? null;
    }

    public function getJenis($jenisId)
    {
        $jenis = $this->find($jenisId);
        if (!empty($jenis) && array_key_exists('jenis', $jenis)) {
            return $jenis['jenis'];
        }
        return '';
    }
}

<?php
namespace App\Models;

use CodeIgniter\Model;

// KelasModel.php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';

    public function getHargaByNama($nama)
{
    $kelas = $this->where('kelas', $nama)->first();
    if ($kelas) {
        $harga = number_format($kelas['harga'], 0, ',', '.');
        return $harga;
    }
    return null;
}
public function getHarga($kelasId)
{
    $kelas = $this->find($kelasId);
    if ($kelas && array_key_exists('harga', $kelas)) {
        return $kelas['harga'];
    }
    return 'Harga tidak ditemukan';
}
}

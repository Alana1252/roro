<?php

namespace App\Models;

use Jenssegers\Date\Date;
use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id_tiket';
    protected $allowedFields = [
        'id_tiket',
        'kapal',
        'keberangkatan',
        'tiba',
        'tanggal',
        'asal',
        'tujuan',
        'kelas',
        'harga',
        'kouta_kendaraan',
        'kouta_penumpang',
    ];
    public function getTanggalFormatted($tanggal, $withDay = true)
    {
        $tanggalObj = Date::createFromFormat('Y-m-d', $tanggal);
        $tanggalObj->setLocale('id');
        if ($withDay) {
            $tanggalFormatted = $tanggalObj->format('l, d F Y');
        } else {
            $tanggalFormatted = $tanggalObj->format('d F Y');
        }
        return $tanggalFormatted;
    }

    public function findAll($limit = 0, $offset = 0, $withDay = true)
    {
        $tikets = parent::findAll($limit, $offset);

        foreach ($tikets as &$tiket) {
            $tanggalFormatted = $this->getTanggalFormatted($tiket['tanggal'], $withDay);
            $tiket['tanggal_formatted'] = $tanggalFormatted;
        }

        return $tikets;
    }

    public function getJamKeberangkatan($jamId)
    {
        $jamModel = new JamModel();
        $jam = $jamModel->find($jamId);
        if ($jam) {
            return $jam['keberangkatan'];
        }
        return '';
    }

    public function getJamTiba($jamId)
    {
        $jamModel = new JamModel();
        $jam = $jamModel->find($jamId);
        if ($jam) {
            return $jam['tiba'];
        }
        return '';
    }

    public function getAsal($tiketId)
    {
        $lokasiModel = new LokasiModel();
        $tiket = $this->find($tiketId);
        if ($tiket) {
            return $lokasiModel->getAsal($tiket['asal']);
        }
        return '';
    }

    public function getJenis($jenisId)
    {
        $kendaraanModel = new KendaraanModel();
        $tiket = $this->find($jenisId);
        if ($tiket) {
            return $kendaraanModel->getJenis($tiket['kouta_kendaraan']);
        }
        return '';
    }

    public function getTujuan($tiketId)
    {
        $lokasiModel = new LokasiModel();
        $tiket = $this->find($tiketId);
        if ($tiket) {
            return $lokasiModel->getTujuan($tiket['tujuan']);
        }
        return '';
    }

    public function getKelasName($kelasId)
    {
        $kelasModel = new KelasModel();
        return $kelasModel->getKelas($kelasId);
    }

    public function getHarga($kelasId)
    {
        $kelasModel = new KelasModel();
        return $kelasModel->getHarga($kelasId);
    }

    public function searchTiket($tanggal, $asal, $kouta_penumpang, $kouta_kendaraan)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set time zone to WIB
        $currentTime = date('H:i:s'); // Current time
        $jamModel = new JamModel();

        // Check if the date is today
        $isToday = (date('Y-m-d') == $tanggal);

        // If not today, don't filter based on the current time
        if (!$isToday) {
            $filteredJamKeberangkatan = $jamModel->findAll(); // Get all departure times
        } else {
            // Get all departure times from the database
            $jamKeberangkatan = $jamModel->findAll();

            // Filter departure times based on the current time
            $filteredJamKeberangkatan = array_filter($jamKeberangkatan, function ($jam) use ($currentTime) {
                return strtotime($jam['keberangkatan']) > strtotime($currentTime);
            });
        }

        // Get the filtered departure time IDs
        $filteredJamIds = array_column($filteredJamKeberangkatan, 'id_jam');

        // Perform the query with additional kouta_penumpang condition
        return $this->where('tanggal', $tanggal)
            ->where('asal', $asal)
            ->whereIn('keberangkatan', $filteredJamIds)

            ->findAll();
    }

    public function getTiketById($id)
    {
        return $this->find($id);
    }
    public function decrementKoutaKendaraan($id_tiket, $koutaKendaraan)
    {
        return $this->db->table('tiket')
            ->where('id_tiket', $id_tiket)
            ->decrement('kouta_kendaraan', $koutaKendaraan);
    }


    public function decrementKoutaPenumpang($id_tiket, $koutaPenumpang)
    {
        return $this->db->table('tiket')
            ->where('id_tiket', $id_tiket)
            ->decrement('kouta_penumpang', $koutaPenumpang);
    }
}

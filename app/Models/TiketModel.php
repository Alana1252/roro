<?php

namespace App\Models;
use Jenssegers\Date\Date;
use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id_tiket';
    protected $allowedFields = [
        'kapal',
        'keberangkatan',
        'tiba',
        'tanggal',
        'asal',
        'tujuan',
        'kelas',
        'harga'
    ];
    public function findAll(int $limit = 0, int $offset = 0)
{
    $tikets = parent::findAll($limit, $offset);

    foreach ($tikets as &$tiket) {
        $tanggal = Date::createFromFormat('Y-m-d', $tiket['tanggal']);
        $tanggal->setLocale('id');
        $tanggalFormatted = $tanggal->format('l, d F Y');
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
    

    public function searchTiket($tanggal, $asal)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke WIB
        $currentTime = date('H:i:s'); // Jam saat ini
        $jamModel = new JamModel();
    
        // Cek apakah tanggal adalah hari ini
        $isToday = (date('Y-m-d') == $tanggal);
    
        // Jika bukan hari ini, jangan memfilter berdasarkan waktu saat ini
        if (!$isToday) {
            $filteredJamKeberangkatan = $jamModel->findAll(); // Ambil semua jam keberangkatan
        } else {
            // Ambil semua jam keberangkatan dari database
            $jamKeberangkatan = $jamModel->findAll();
    
            // Filter jam keberangkatan berdasarkan waktu saat ini
            $filteredJamKeberangkatan = array_filter($jamKeberangkatan, function($jam) use ($currentTime) {
                return strtotime($jam['keberangkatan']) > strtotime($currentTime);
            });
        }
    
        // Ambil ID jam keberangkatan yang sudah difilter
        $filteredJamIds = array_column($filteredJamKeberangkatan, 'id_jam');
    
        return $this->where('tanggal', $tanggal)
                    ->whereIn('asal', [$asal])
                    ->whereIn('keberangkatan', $filteredJamIds)
                    ->findAll();
    }
    
}    

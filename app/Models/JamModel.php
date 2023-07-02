<?php

namespace App\Models;

use CodeIgniter\Model;

class JamModel extends Model
{
    protected $table = 'jam';
    protected $primaryKey = 'id_jam';
    protected $allowedFields = ['keberangkatan', 'tiba'];

    public function getJamKeberangkatan($jamId)
    {
        $jam = $this->find($jamId);
        if ($jam) {
            return date('H:i', strtotime($jam['keberangkatan']));
        }
        return '';
    }

    public function getJamTiba($jamId)
    {
        $jam = $this->find($jamId);
        if ($jam) {
            return date('H:i', strtotime($jam['tiba']));
        }
        return '';
    }
}

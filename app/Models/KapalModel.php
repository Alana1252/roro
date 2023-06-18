<?php

namespace App\Models;

use CodeIgniter\Model;

class KapalModel extends Model
{
    protected $table = 'kapal';
    protected $primaryKey = 'id_kapal';
    protected $allowedFields = ['kapal'];

    public function getKapalName($kapalId)
    {
        $kapal = $this->find($kapalId);
        if ($kapal) {
            return $kapal['kapal'];
        }
        return '';
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class News_model extends Model
{
    protected $table = 'news';
    protected $allowedFields = ['title', 'deskripsi', 'date', 'photo'];
    
    public function getLatestNews($limit = 5)
    {
        return $this->orderBy('date', 'DESC')->limit($limit)->findAll();
    }
}

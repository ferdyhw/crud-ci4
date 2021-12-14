<?php

namespace App\Models;

use CodeIgniter\Model;

class Orang_model extends Model
{
    protected $table = 'orang';
    protected $useTimestamps = TRUE;

    public function getOrang($id = FALSE)
    {
        if ($id == FALSE) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
    }
}

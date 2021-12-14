<?php

namespace App\Models;

use CodeIgniter\Model;

class Komik_model extends Model
{
    protected $table = 'komik';
    protected $useTimestamps = TRUE;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    public function getKomik($slug = FALSE)
    {
        if ($slug == FALSE) {

            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function hapusKomik($id)
    {
        $hapus = $this->delete($id);
        return $hapus;
    }
}

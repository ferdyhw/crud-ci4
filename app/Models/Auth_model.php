<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth_model extends Model
{
    protected $table = 'user';
    protected $useTimestamps = TRUE;

    public function cekLogin()
    {
    }
}

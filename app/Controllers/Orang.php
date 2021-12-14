<?php

namespace App\Controllers;

use App\Models\Orang_model;

class Orang extends BaseController
{
    protected $_orangModel;
    public function __construct()
    {
        $this->_orangModel = new Orang_model();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $this->_orangModel->search($keyword);
        } else {
            $this->_orangModel->getOrang();
        }

        $data = [
            'judul' => 'App CI4 | Orang',
            'orang' => $this->_orangModel->paginate(5, 'orang'),
            'pager' => $this->_orangModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/orang/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'judul' => 'App CI4 | Detail Orang',
            'orang' => $this->_orangModel->getOrang(['id' => $id])
        ];
        if (empty($data['orang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Daftar orang dengan ID ' . $id . ' tidak ditemukan.');
        }
        return view('/orang/detail', $data);
    }
}

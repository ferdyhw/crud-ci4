<?php

namespace App\Controllers;

use App\Models\Komik_model;

class Komik extends BaseController
{
    protected $_komikModel;
    public function __construct()
    {
        $this->_komikModel = new Komik_model();
    }

    public function index()
    {
        $data = [
            'judul' => 'App CI4 | Komik',
            'komik' => $this->_komikModel->getKomik()
        ];
        return view('/komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'judul' => 'App CI4 | Detail Komik',
            'komik' => $this->_komikModel->getKomik(['slug' => $slug])
        ];
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan.');
        }
        return view('/komik/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'judul' => 'App CI4 | Tambah Komik',
            'validation' => \Config\Services::validation()

        ];
        return view('/komik/tambah', $data);
    }

    public function prosesTambah()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul komik sudah terdaftar.'
                ]
            ],
            'penulis' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                    'alpha_space' => 'Penulis harus diisi hanya dengan huruf.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerbit harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file cover maksimal 1MB.',
                    'is_image' => 'Cover harus berupa gambar.',
                    'mime_in' => 'File cover harus berektensi [JPG, JPEG, PNG]'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/komik/tambah')->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getPost('judul'), '-', TRUE);
        $this->_komikModel->save([
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashData('flash', 'ditambah');
        return redirect()->to('/komik');
    }

    public function hapus($id)
    {
        // Cari Gambar
        $komik = $this->_komikModel->find($id);
        // Cek Gambar
        if ($komik['sampul'] != 'default.png') {
            // Hapus Gambar
            unlink('img/' . $komik['sampul']);
        }
        $this->_komikModel->hapusKomik($id);
        session()->setFlashData('flash', 'dihapus');
        return redirect()->to('/komik');
    }

    public function ubah($slug)
    {
        $data = [
            'judul' => 'App CI4 | Edit Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->_komikModel->getKomik($slug)

        ];
        return view('/komik/ubah', $data);
    }

    public function prosesUbah($id)
    {
        $komikLama = $this->_komikModel->getKomik($this->request->getVar('slug'));
        dd($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul komik sudah terdaftar.'
                ]
            ],
            'penulis' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                    'alpha_space' => 'Penulis harus diisi hanya dengan huruf.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerbit harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file cover maksimal 1MB.',
                    'is_image' => 'Cover harus berupa gambar.',
                    'mime_in' => 'File cover harus berektensi [JPG, JPEG, PNG]'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/komik/ubah/' . $this->request->getVar('slug'))->withInput();
        }
        $fileSampul = $this->request->getFile('sampul');
        $sampulLama = $this->request->getVar('sampulLama');
        // Cek Gambar Lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $sampulLama;
        } else {
            // Generate nama gambar
            $namaSampul = $fileSampul->getRandomName();
            // Pindah gambar
            $fileSampul->move('img', $namaSampul);
            // Hapus file lama
            unlink('img/' . $sampulLama);
        }

        $slug = url_title($this->request->getPost('judul'), '-', TRUE);
        $this->_komikModel->save([
            'id' => $id,
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashData('flash', 'diubah');
        return redirect()->to('/komik');
    }
}

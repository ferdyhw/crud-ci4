<?php

namespace App\Controllers;

use App\Models\Auth_model;

class Auth extends BaseController
{
    protected $_authModel;
    public function __construct()
    {
        $this->_authModel = new Auth_model();
    }

    public function index()
    {
        $data = [
            'judul' => 'App CI4 | Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'alpha_numeric' => 'Username harus berisi huruf dan angka saja.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to('/auth')->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->_authModel->where(['username' => $username])->first();

        if ($user) {

            if ($password == $user['password']) {
                $setData = [
                    'id' => $user['id']
                ];
                session()->set($setData);
                return redirect()->to('/home');
            } else {
                session()->setFlashData('flash', 'Password salah.');
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashData('flash', 'Username tidak terdaftar.');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

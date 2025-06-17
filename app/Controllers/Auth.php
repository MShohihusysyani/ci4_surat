<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        // Inisialisasi model
        $this->userModel = new UserModel();
    }
    public function index()
    {
        // Jika sudah login maka redirect ke halaman home
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/home');
        }
        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function cekUser()
    {
        // Ambil data input login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Pakai UserModel langsung
        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            session()->setFlashdata('alert', 'User tidak ditemukan.');
            return redirect()->to('/');
        }

        // Verifikasi password
        if (!password_verify($password, $user->password)) {
            session()->setFlashdata('alert', 'Username atau Password salah!');
            return redirect()->to('/');
        }

        // Set session
        session()->set([
            'id_user'     => $user->id_user,
            'username'    => $user->username,
            'nama_user'   => $user->nama_user,
            'role'        => $user->role,
            'divisi'      => $user->divisi,
            'klien_id'    => $user->klien_id,
            'karyawan_id' => $user->karyawan_id,
            'isLoggedIn' => true,
        ]);

        session()->setFlashdata('pesan', 'Anda Berhasil Login!');
        return redirect()->to('/home');
    }

    public function logout()
    {
        session()->setFlashdata('pesan', 'Berhasil Logout');
        session()->destroy();
        return redirect()->to('/');
    }
}

<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\KlienModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel, $roleModel, $klienModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->klienModel = new KlienModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->userModel->getData(),
        ];

        return view('kelola/user/index', $data);
    }

    public function tambah()
    {

        $data = [
            'title' => 'Tambah User',
            'roles' => $this->roleModel->findAll(),
            'kliens' => $this->klienModel->getAllKlien(),
        ];

        return view('kelola/user/tambah', $data);
    }

    public function simpan()
    {
        // Validasi hanya untuk username (wajib & unik)
        $validationRules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            // 'foto' => [
            //     'label' => 'Foto',
            //     'rules' => 'if_exist|max_size[foto,25600]|mime_in[foto,image/jpeg,image/jpg,image/png]',
            //     'errors' => [
            //         'max_size' => '{field} maksimal 25MB.',
            //         'mime_in' => '{field} harus berupa gambar jpeg/jpg/png.'
            //     ]
            // ]
            // 'foto' => [
            //     'label' => 'Foto',
            //     'rules' => 'uploaded[foto]|max_size[foto,25600]|mime_in[foto,image/jpeg,image/jpg,image/png]',
            //     'errors' => [
            //         // 'uploaded' => '{field} harus diunggah.',
            //         'max_size' => '{field} maksimal 25MB.',
            //         'mime_in' => '{field} harus berupa gambar jpeg/jpg/png.'
            //     ]
            // ]
        ];

        // Jika ada file yang benar dikirim (bukan sekadar input kosong)
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $rules['foto'] = [
                'label' => 'Foto',
                'rules' => 'max_size[foto,25600]|mime_in[foto,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in' => '{field} harus berupa gambar jpeg/jpg/png.'
                ]
            ];
        }

        if (!$this->validate($validationRules)) {
            // Ambil semua error dan kirim ke flashdata
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            session()->setFlashdata('validation_errors', $errors);
            session()->setFlashdata('swal_error', 'Data gagal ditambahkan!');

            return redirect()->to('/kelola/user/tambah')->withInput();
        }

        // Upload file
        // $foto = $this->request->getFile('foto');
        // $namaFoto = null;

        // if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        //     $namaFoto = $foto->getRandomName();
        //     $foto->move('img/foto_user', $namaFoto);
        // }

        try {
            $this->userModel->save([
                'username'     => $this->request->getPost('username'),
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nama_user'    => $this->request->getPost('nama_user'),
                'email'        => $this->request->getPost('email'),
                'no_hp'        => $this->request->getPost('no_hp'),
                'foto'         => $foto,
                'tgl_register' => $this->request->getPost('tgl_register'),
                'status_user'  => 'Aktif',
                'role'         => $this->request->getPost('role'),
                'klien_id'     => $this->request->getPost('klien_id'),
                'divisi'       => $this->request->getPost('divisi')
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/kelola/user');
    }


    public function edit($id)
    {
        $data = [
            'title'  => 'Edit User',
            'users'  => $this->userModel->getUser($id),
            'roles'  => $this->roleModel->findAll(),
            'kliens' => $this->klienModel->getAllKlien(),
        ];

        return view('kelola/user/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        // Aturan validasi
        $validationRules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],

            // Validasi opsional untuk file foto
            'foto' => [
                'label' => 'Foto',
                'rules' => 'if_exist|max_size[foto,25600]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in' => '{field} harus berupa JPG, JPEG, atau PNG.'
                ]
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation_errors', $this->validator);
        }

        // Data input dasar
        $data = [
            'username'     => $this->request->getPost('username'),
            'nama_user'    => $this->request->getPost('nama_user'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'tgl_register' => $this->request->getPost('tgl_register'),
            'role'         => $this->request->getPost('role'),
            'klien_id'     => $this->request->getPost('klien_id'),
            'divisi'       => $this->request->getPost('divisi')
        ];

        // Jika password diisi, hash dan simpan
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Handle foto
        $photo = $this->request->getFile('foto');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(FCPATH . 'img/foto_user/' . $user->foto)) {
                unlink(FCPATH . 'img/foto_user/' . $user->foto);
            }

            // Simpan foto baru
            $newPhoto = $photo->getRandomName();
            $photo->move('img/foto_user', $newPhoto);
            $data['foto'] = $newPhoto;
        } else {
            // Tetap gunakan foto lama jika tidak upload baru
            $data['foto'] = $user->foto;
        }

        // Simpan ke database
        $this->userModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data berhasil dirubah');
        return redirect()->to('/kelola/user');
    }

    public function hapus($id)
    {
        try {
            $user = $this->userModel->find($id);
            if ($user && $user->foto) {
                $logoPath = 'img/foto_user/' . $user->foto;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $this->userModel->delete($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            session()->setFlashdata('alert', 'Data gagal dihapus.');
            // log_message('error', 'Gagal menghapus produk: ' . $th->getMessage());
        }
        return redirect()->to('kelola/user');
    }
    public function update_status()
    {
        $id = $this->request->getPost('id_user');
        $status = $this->request->getPost('status_user');

        $update = $this->userModel->update($id, ['status_user' => $status]);

        if ($update) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal update data']);
        }
    }



    // public function update($id)
    // {
    //     $user = $this->userModel->find($id);

    //     $data = [
    //         'username'     => $this->request->getPost('username'),
    //         'nama_user'    => $this->request->getPost('nama_user'),
    //         'email'        => $this->request->getPost('email'),
    //         'no_hp'        => $this->request->getPost('no_hp'),
    //         'tgl_register' => $this->request->getPost('tgl_register'),
    //         'status_user'  => 'Aktif',
    //         'role'         => $this->request->getPost('role'),
    //         'divisi'       => $this->request->getPost('divisi')

    //     ];

    //     // Cek apakah password diinputkan
    //     $password = $this->request->getVar('password');
    //     if (!empty($password)) {
    //         $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    //     }

    //     // Handle Foto
    //     $photo = $this->request->getFile('foto');
    //     if ($photo && $photo->isValid() && !$photo->hasMoved()) {
    //         $newPhoto = $photo->getRandomName();
    //         $photo->move('img/foto_user', $newPhoto);
    //         $data['foto'] = $newPhoto;
    //     } else {
    //         $data['foto'] = $user->foto;
    //     }

    //     $this->userModel->update($id, $data);

    //     session()->setFlashdata('pesan', 'Data Berhasil dirubah');
    //     return redirect()->to('kelola/user');
    // }
}

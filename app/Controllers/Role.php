<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use CodeIgniter\HTTP\ResponseInterface;

class Role extends BaseController
{
    protected $roleModel;
    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Role',
            'roles' => $this->roleModel->findAll(),
        ];

        return view('kelola/role/index', $data);
    }

    public function tambah()
    {
        $valid = $this->validate([
            'nama_role' => [
                'label' => 'Nama Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ]);

        if (!$valid) {
            $error = $this->validator->listErrors();
            session()->setFlashdata('alert', $error);

            return redirect()->back()->withInput();
        }

        $data = [
            'nama_role' => $this->request->getPost('nama_role')
        ];

        $this->roleModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/kelola/role');
    }

    public function update()
    {
        //validasi data
        $valid = $this->validate([
            'nama_role' => [
                'label' => 'Nama Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ]);

        if (!$valid) {
            $error = $this->validator->listErrors();
            session()->setFlashdata('error', $error);

            return redirect()->back()->withInput();
        }

        $data = [
            'nama_role' => $this->request->getPost('nama_role')
        ];
        $id = $this->request->getPost('id_role');

        //jika data berhasil diupdate, kembalikan pesan sukses
        if ($this->roleModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diupdate.');
            return redirect()->to('/kelola/role');
        } else {
            session()->setFlashdata('alert', 'Data gagal diupdate.');
            return redirect()->to('/kelola/role');
        }
    }

    public function hapus($id)
    {
        $this->roleModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kelola/role');
    }
}

<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jabatan extends BaseController
{
    protected $jabatanModel;
    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Jabatan',
            'jabatans' => $this->jabatanModel->findAll(),
        ];

        return view('kelola/jabatan/index', $data);
    }

    public function tambah()
    {
        $valid = $this->validate([
            'nama_jabatan' => [
                'label' => 'Nama Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'level_jabatan' => [
                'label' => 'Level Jabatan',
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
            'nama_jabatan'  => $this->request->getPost('nama_jabatan'),
            'level_jabatan' => $this->request->getPost('level_jabatan')
        ];

        $this->jabatanModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/kelola/jabatan');
    }

    public function update()
    {
        //validasi data
        $valid = $this->validate([
            'nama_jabatan' => [
                'label' => 'Nama Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'level_jabatan' => [
                'label' => 'Level Jabatan',
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
            'nama_jabatan'  => $this->request->getPost('nama_jabatan'),
            'level_jabatan' => $this->request->getPost('level_jabatan')
        ];
        $id = $this->request->getPost('id_jabatan');

        //jika data berhasil diupdate, kembalikan pesan sukses
        if ($this->jabatanModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diupdate.');
            return redirect()->to('/kelola/jabatan');
        } else {
            session()->setFlashdata('alert', 'Data gagal diupdate.');
            return redirect()->to('/kelola/jabatan');
        }
    }

    public function hapus($id)
    {
        $this->jabatanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kelola/jabatan');
    }
}

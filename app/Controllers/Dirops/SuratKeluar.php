<?php

namespace App\Controllers\Dirops;

use App\Models\UserModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DisposisiSuratKeluarModel;

class SuratKeluar extends BaseController
{
    protected $suratKeluarModel, $disposisiSuratKeluarModel, $userModel;
    public function __construct()
    {
        $this->suratKeluarModel          = new SuratKeluarModel();
        $this->disposisiSuratKeluarModel = new DisposisiSuratKeluarModel();
        $this->userModel                 = new UserModel();
    }
    public function index()
    {
        $data = [
            'title'        => 'Surat Keluar',
            'suratkeluars' => $this->suratKeluarModel->getDisposisi(),
            'users'        => $this->userModel->getDirut(),
        ];

        return view('dirops/surat_keluar/index', $data);
    }

    public function disposisi()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_keluar' => 'required',
            'namadirut' => [
                'label' => 'Dirut',
                'rules' => 'required',
                'errors' => ['required' => 'Dirut wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/dirops/surat-keluar'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_keluar');
        $id_user = $this->request->getPost('namadirut');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/dirops/surat-keluar'));
        }

        // Simpan atau update catatan;
        $data = [
            'surat_keluar_id' => $id_surat,
            'user_id' => $id_user
        ];

        $this->disposisiSuratKeluarModel->insert($data);

        // Update status surat masuk
        $this->suratKeluarModel->disposisi($id_surat);

        // // Simpan riwayat
        // $this->riwayatSuratMasukModel->insert([
        //     'surat_masuk_id' => $id_surat,
        //     'status'         => $status,
        //     'keterangan'     => 'dirops ' . ($status === 'Updated' ? 'memperbarui' : 'memberikan') . ' catatan',
        //     'user_id'        => $id_user,
        //     'created_at'     => date('Y-m-d H:i:s')
        // ]);

        // kirim_notif_disposisi_surat_masuk($id_user, $id_surat);

        session()->setFlashdata('pesan',  'Berhasil disposisi!');
        return redirect()->to(base_url('/dirops/surat-keluar'));
    }
}

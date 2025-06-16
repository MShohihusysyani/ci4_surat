<?php

namespace App\Controllers\Kadiv;

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
            'users'        => $this->userModel->getDirops(),
            'suratkeluars' => $this->suratKeluarModel->getDataDraft(),
        ];

        return view('kadiv/surat_keluar/index', $data);
    }

    public function disposisi()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_keluar' => 'required',
            'namadirops' => [
                'label' => 'Dirops',
                'rules' => 'required',
                'errors' => ['required' => 'Dirops wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/kadiv/surat-keluar'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_keluar');
        $id_user = $this->request->getPost('namadirops');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/kadiv/surat-keluar'));
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
        //     'keterangan'     => 'Kadiv ' . ($status === 'Updated' ? 'memperbarui' : 'memberikan') . ' catatan',
        //     'user_id'        => $id_user,
        //     'created_at'     => date('Y-m-d H:i:s')
        // ]);

        // kirim_notif_disposisi_surat_masuk($id_user, $id_surat);

        session()->setFlashdata('pesan',  'Berhasil disposisi!');
        return redirect()->to(base_url('/kadiv/surat-keluar'));
    }
}

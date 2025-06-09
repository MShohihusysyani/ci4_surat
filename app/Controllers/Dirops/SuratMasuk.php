<?php

namespace App\Controllers\Dirops;

use App\Models\UserModel;
use App\Models\SuratMasukModel;
use App\Models\DisposisiAtasModel;
use App\Controllers\BaseController;
use App\Models\DisposisiBawahModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $disposisiAtasanModel, $disposisiBawahanModel, $userModel;
    public function __construct()
    {
        $this->suratMasukModel       = new SuratMasukModel();
        $this->disposisiAtasanModel  = new DisposisiAtasModel();
        $this->disposisiBawahanModel = new DisposisiBawahModel();
        $this->userModel             = new UserModel();
    }
    public function index()
    {
        $data = [
            'title'             => 'Surat Masuk',
            'users'             => $this->userModel->getDirut(),
            'users_k'           => $this->userModel->getKadiv(),
            'disposisiatasan'   => $this->disposisiAtasanModel->getDataDirops(),
            'disposisibawahans' => $this->disposisiBawahanModel->getData(),
        ];
        return view('dirops/surat_masuk/index', $data);
    }

    public function disposisi_keatasan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namadirut' => [
                'label' => 'Dirut',
                'rules' => 'required',
                'errors' => ['required' => 'Dirut wajib diisi.']
            ],
            'catatan_dirops' => [
                'label' => 'Catatan dirops',
                'rules' => 'required',
                'errors' => ['required' => 'Catatan wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/dirops/surat-masuk'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namadirut');
        $catatan_dirops = $this->request->getPost('catatan_dirops');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/dirops/surat-masuk'));
        }

        $nama_user = $user->nama_user;

        // Simpan atau update catatan;
        $status = $this->disposisiAtasanModel->simpanAtauUpdate($id_surat, $id_user, [
            'surat_masuk_id'     => $id_surat,
            'user_id'      => $id_user,
        ]);

        // Update status surat masuk
        $this->suratMasukModel->disposisiKeatasan($id_surat, $nama_user);

        // Update kolom catatan_kadiv di surat_masuk
        $this->suratMasukModel->updateCatatanDirops($id_surat, $catatan_dirops);

        // // Simpan riwayat
        // $this->riwayatSuratMasukModel->insert([
        //     'surat_masuk_id' => $id_surat,
        //     'status'         => $status,
        //     'keterangan'     => 'Kadiv ' . ($status === 'Updated' ? 'memperbarui' : 'memberikan') . ' catatan',
        //     'user_id'        => $id_user,
        //     'created_at'     => date('Y-m-d H:i:s')
        // ]);

        // kirim_notif_disposisi_surat_masuk($id_user, $id_surat);

        session()->setFlashdata('pesan', $status === 'Updated' ? 'Disposisi berhasil diperbarui!' : 'Berhasil disposisi!');
        return redirect()->to(base_url('/dirops/surat-masuk'));
    }

    public function disposisi_kebawahan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namakadiv' => [
                'label' => 'kadiv',
                'rules' => 'required',
                'errors' => [
                    'required' => ' kadiv wajib diisi.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('alert', 'Kadiv wajib diisi.');
            return redirect()->to(base_url('/dirops/surat-masuk'));
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namakadiv');
        $disposisi_select = $this->request->getPost('disposisi_dirops_select');
        $disposisi_textarea = $this->request->getPost('disposisi_dirops_manual');

        if (empty($disposisi_select) && empty($disposisi_textarea)) {
            session()->setFlashdata('alert', 'Disposisi wajib diisi, baik dari pilihan atau catatan.');
            return redirect()->to(base_url('/dirops/surat-masuk'))->withInput();
        }

        $disposisi_dirops = $disposisi_select ?: $disposisi_textarea;

        // $disposisi_dirut = $this->request->getPost('disposisi_dirut_select') ?: $this->request->getPost('disposisi_dirut_manual');

        // Ambil nama user
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('alert', 'User tidak ditemukan.');
            return redirect()->to(base_url('/dirops/surat-masuk'));
        }
        $nama_user = $user->nama_user;

        // Simpan atau update disposisi
        $status = $this->disposisiBawahanModel->simpanAtauUpdate($id_surat, $id_user, [
            'surat_masuk_id' => $id_surat,
            'user_id'        => $id_user,
        ]);

        // Update kolom disposisi_dirut di surat_masuk
        $this->suratMasukModel->updateDisposisiDiropsText($id_surat, $disposisi_dirops);

        // Update user_id disposisi dirut di surat masuk (fungsi ini kamu sudah punya)
        $this->suratMasukModel->disposisi_kekadiv($id_surat, $nama_user);

        // // Simpan riwayat
        // $this->riwayatSuratMasukModel->insert([
        //     'surat_masuk_id' => $id_surat,
        //     'status'         => $status,
        //     'keterangan'     => 'Dirut ' . ($status === 'Updated' ? 'memperbarui' : 'memberikan') . ' disposisi',
        //     'user_id'        => $id_user,
        //     'created_at'     => date('Y-m-d H:i:s')
        // ]);

        // kirim_notif_disposisi_surat_masuk($id_user, $id_surat);

        session()->setFlashdata('pesan', $status === 'Updated' ? 'Disposisi berhasil diperbarui!' : 'Berhasil Disposisi!');
        return redirect()->to(base_url('dirops/surat-masuk'));
    }
}

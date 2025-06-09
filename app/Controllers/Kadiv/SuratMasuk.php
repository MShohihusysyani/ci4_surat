<?php

namespace App\Controllers\Kadiv;

use App\Models\UserModel;
use App\Models\SuratMasukModel;
use App\Models\DisposisiAtasModel;
use App\Controllers\BaseController;
use App\Models\DisposisiBawahModel;
use App\Models\DisposisiKadivModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $disposisiKadivModel, $disposisiAtasanModel, $disposisiBawahanModel, $userModel;

    public function __construct()
    {
        $this->suratMasukModel      = new SuratMasukModel();
        $this->disposisiKadivModel  = new DisposisiKadivModel();
        $this->disposisiAtasanModel = new DisposisiAtasModel();
        $this->disposisiBawahanModel  = new DisposisiBawahModel();
        $this->userModel            = new UserModel();
    }
    public function index()
    {
        $divisi_kadiv = session()->get('divisi');

        // Ambil staf sesuai divisi Kadiv yang login
        $staf_users = $this->userModel->getStaf($divisi_kadiv);

        // Jika Kadiv berasal dari CBS, ambil juga daftar Kadiv dari divisi lain
        $kadiv_lain = [];
        if ($divisi_kadiv == 'cbs') {
            $kadiv_lain = $this->userModel->getKadivNonCbs($divisi_kadiv);
        }

        $data = [
            'title'             => 'Surat Masuk',
            'disposisiatasan'   => $this->disposisiKadivModel->getData(),
            'users'             => $this->userModel->getDirops(),
            'disposisibawahans' => $this->disposisiBawahanModel->getData(),
            'staf_users'        => $staf_users,
            'kadiv_lain'        => $kadiv_lain,
        ];
        return view('kadiv/surat_masuk/index', $data);
    }

    public function disposisi_keatasan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namadirops' => [
                'label' => 'Dirops',
                'rules' => 'required',
                'errors' => ['required' => 'Dirops wajib diisi.']
            ],
            'catatan_kadiv' => [
                'label' => 'Catatan Kadiv',
                'rules' => 'required',
                'errors' => ['required' => 'Catatan wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/kadiv/surat-masuk'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namadirops');
        $catatan_kadiv = $this->request->getPost('catatan_kadiv');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/kadiv/surat-masuk'));
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
        $this->suratMasukModel->updateCatatanKadiv($id_surat, $catatan_kadiv);

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
        return redirect()->to(base_url('/kadiv/surat-masuk'));
    }

    public function disposisi_kebawahan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namastaf' => [
                'label' => 'Staf',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Staf wajib diisi.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('alert', 'Staf wajib diisi.');
            return redirect()->to(base_url('/kadiv/surat-masuk'));
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namastaf');
        $disposisi_select = $this->request->getPost('disposisi_kadiv_select');
        $disposisi_textarea = $this->request->getPost('disposisi_kadiv_manual');

        if (empty($disposisi_select) && empty($disposisi_textarea)) {
            session()->setFlashdata('alert', 'Disposisi wajib diisi, baik dari pilihan atau catatan.');
            return redirect()->to(base_url('/kadiv/surat-masuk'))->withInput();
        }

        $disposisi_kadiv = $disposisi_select ?: $disposisi_textarea;

        // $disposisi_dirut = $this->request->getPost('disposisi_dirut_select') ?: $this->request->getPost('disposisi_dirut_manual');

        // Ambil nama user
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('alert', 'User tidak ditemukan.');
            return redirect()->to(base_url('/kadiv/surat-masuk'));
        }
        $nama_user = $user->nama_user;

        // Simpan atau update disposisi
        $status = $this->disposisiBawahanModel->simpanAtauUpdate($id_surat, $id_user, [
            'surat_masuk_id' => $id_surat,
            'user_id'        => $id_user,
        ]);

        // Update kolom disposisi_dirut di surat_masuk
        $this->suratMasukModel->updateDisposisiKadivText($id_surat, $disposisi_kadiv);

        // Update user_id disposisi dirut di surat masuk (fungsi ini kamu sudah punya)
        $this->suratMasukModel->disposisi_kestaf($id_surat, $nama_user);

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
        return redirect()->to(base_url('/kadiv/surat-masuk'));
    }
}

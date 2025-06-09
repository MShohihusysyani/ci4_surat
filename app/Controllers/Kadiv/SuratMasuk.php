<?php

namespace App\Controllers\Kadiv;

use App\Models\UserModel;
use App\Models\SuratMasukModel;
use App\Models\DisposisiAtasModel;
use App\Controllers\BaseController;
use App\Models\DisposisiKadivModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $disposisiKadivModel, $disposisiAtasanModel, $userModel;

    public function __construct()
    {
        $this->suratMasukModel      = new SuratMasukModel();
        $this->disposisiKadivModel  = new DisposisiKadivModel();
        $this->disposisiAtasanModel = new DisposisiAtasModel();
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
            'title'          => 'Surat Masuk',
            'disposisiatasan'  => $this->disposisiKadivModel->getData(),
            'users'          => $this->userModel->getDirops(),
            // 'disposisibawah' => $this->disposisiModel->getDisposisiSurat(),
            'staf_users'     => $staf_users,
            'kadiv_lain'     => $kadiv_lain,
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
}

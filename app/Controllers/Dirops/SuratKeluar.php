<?php

namespace App\Controllers\Dirops;

use App\Models\UserModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratKeluarApprovalModel;
use App\Models\DisposisiSuratKeluarModel;

class SuratKeluar extends BaseController
{
    protected $suratKeluarModel, $disposisiSuratKeluarModel, $suratKeluarApprovalModel, $userModel;
    public function __construct()
    {
        $this->suratKeluarModel          = new SuratKeluarModel();
        $this->disposisiSuratKeluarModel = new DisposisiSuratKeluarModel();
        $this->suratKeluarApprovalModel  = new SuratKeluarApprovalModel();
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

    public function approve()
    {
        $id_surat = $this->request->getPost('id_surat_keluar');
        if (empty($id_surat)) {
            session()->setFlashdata('error', 'ID surat tidak ditemukan.');
            return redirect()->back();
        }

        $surat = $this->suratKeluarModel->find($id_surat);
        if (!$surat) {
            session()->setFlashdata('error', 'Surat tidak ditemukan.');
            return redirect()->back();
        }

        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        // Ambil data user
        $userId   = session()->get('id_user');

        // Generate kode verifikasi hanya jika belum ada
        if (empty($surat->qrcode)) {
            $kodeVerifikasi = bin2hex(random_bytes(16)); // 32 char
            $this->suratKeluarModel->update($id_surat, [
                'qrcode' => $kodeVerifikasi,
                'progres' => 'Approve'
            ]);
        } else {
            $kodeVerifikasi = $surat->qrcode;
        }

        // Simpan ke tabel approval
        $this->suratKeluarApprovalModel->save([
            'surat_keluar_id' => $id_surat,
            'approved_at'     => $now,
            'user_id'         => $userId
        ]);

        // Simpan riwayat
        // $this->riwayatSuratKeluarModel->save([
        //     'surat_keluar_id' => $id_surat,
        //     'status'          => 'Approved',
        //     'keterangan'      => "Disetujui oleh $role",
        //     'created_at'      => $now,
        //     'user_id'         => $userId,
        // ]);

        // // Log user
        // log_user($userId, 'approve', "$namaUser ($role) menyetujui surat keluar");

        // Kirim notifikasi hanya jika semua pihak sudah approve (opsional)
        // $this->cekSemuaApprovalSelesaiDanKirimNotif($id_surat);

        session()->setFlashdata('pesan', 'Berhasil approve surat.');
        return redirect()->to(base_url('dirops/surat-keluar'));
    }
}

<?php

namespace App\Controllers\Dirut;

use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratKeluarApprovalModel;

class SuratKeluar extends BaseController
{
    protected $suratKeluarModel, $suratKeluarApprovalModel;
    public function __construct()
    {
        $this->suratKeluarModel         = new SuratKeluarModel();
        $this->suratKeluarApprovalModel = new SuratKeluarApprovalModel();
    }
    public function index()
    {
        $data = [
            'title'        => 'Surat Keluar',
            'suratkeluars' => $this->suratKeluarModel->getDisposisi(),
        ];

        return view('dirut/surat_keluar/index', $data);
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
        return redirect()->to(base_url('dirut/surat-keluar'));
    }
}

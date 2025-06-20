<?php

namespace App\Controllers\Dirut;

use App\Models\SuratTugasModel;
use App\Controllers\BaseController;
use App\Models\SuratTugasApprovalModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratTugas extends BaseController
{
    protected $suratTugasModel, $suratTugasApprovalModel;
    public function __construct()
    {
        $this->suratTugasModel         = new SuratTugasModel();
        $this->suratTugasApprovalModel = new SuratTugasApprovalModel();
    }
    public function index()
    {
        $data = [
            'title'       => 'Surat Tugas',
            'surat_tugas' => $this->suratTugasModel->getSuratByUser(),
        ];

        return view('dirut/surat_tugas/index', $data);
    }

    public function approve()
    {
        $id_surat = $this->request->getPost('id_surat_tugas');
        if (empty($id_surat)) {
            session()->setFlashdata('error', 'ID surat tidak ditemukan.');
            return redirect()->back();
        }

        $surat = $this->suratTugasModel->find($id_surat);
        if (!$surat) {
            session()->setFlashdata('error', 'Surat tidak ditemukan.');
            return redirect()->back();
        }

        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        // Ambil data user
        $user_id   = session()->get('id_user');

        // Generate kode verifikasi hanya jika belum ada
        if (empty($surat->qrcode)) {
            $kode_verifikasi = bin2hex(random_bytes(16)); // 32 char
            $this->suratTugasModel->update($id_surat, [
                'qrcode' => $kode_verifikasi,
                'progres' => 'Approve'
            ]);
        } else {
            $kode_verifikasi = $surat->qrcode;
        }

        // Simpan ke tabel approval
        $this->suratTugasApprovalModel->save([
            'surat_tugas_id' => $id_surat,
            'approved_at'     => $now,
            'user_id'         => $user_id
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
        return redirect()->to(base_url('dirut/surat-tugas'));
    }
}

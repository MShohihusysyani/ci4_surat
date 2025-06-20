<?php

namespace App\Controllers;

use App\Models\SuratTugasModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use App\Models\SuratTugasApprovalModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratKeluarApprovalModel;

class Pindai extends BaseController
{
    protected $suratKeluarModel, $suratTugasModel, $approveModel, $approveTugasModel;
    public function __construct()
    {
        $this->suratKeluarModel  = new SuratKeluarModel();
        $this->suratTugasModel   = new SuratTugasModel();
        $this->approveModel      = new SuratKeluarApprovalModel();
        $this->approveTugasModel = new SuratTugasApprovalModel();
    }
    public function detail($kodeVerifikasi)
    {
        // Ambil surat keluar lengkap + nama + jabatan
        $surat = $this->suratKeluarModel->getDetailByKode($kodeVerifikasi);

        if (!$surat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kode verifikasi tidak ditemukan.");
        }

        // Ambil approval
        $approval = $this->approveModel->getBySuratKeluarId($surat->id_surat_keluar);

        return view('verifikasi/detail', [
            'title'    => 'Detail Verifikasi Surat',
            'surat'    => $surat,
            'approval' => $approval
        ]);
    }

    public function detail_surat_tugas($kodeVerifikasi)
    {
        // Ambil surat keluar lengkap + nama + jabatan
        $surat = $this->suratTugasModel->getDetailByKode($kodeVerifikasi);

        if (!$surat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kode verifikasi tidak ditemukan.");
        }

        // Ambil approval
        $approval = $this->approveTugasModel->getBySuratTugasId($surat->id_surat_tugas);

        return view('verifikasi/detail_surat_tugas', [
            'title'    => 'Detail Verifikasi Surat',
            'surat'    => $surat,
            'approval' => $approval
        ]);
    }
}

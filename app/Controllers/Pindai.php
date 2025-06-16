<?php

namespace App\Controllers;

use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratKeluarApprovalModel;

class Pindai extends BaseController
{
    protected $suratKeluarModel, $approveModel;
    public function __construct()
    {
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->approveModel     = new SuratKeluarApprovalModel();
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
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KlienModel;
use App\Models\ProdukModel;
use App\Models\KaryawanModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;

class Home extends BaseController
{
    protected $suratMasukModel, $suratKeluarModel, $userModel, $karyawanModel, $klienModel, $produkModel;
    public function __construct()
    {
        $this->suratMasukModel  = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->userModel        = new UserModel();
        $this->karyawanModel    = new KaryawanModel();
        $this->klienModel       = new KlienModel();
        $this->produkModel      = new ProdukModel();
    }
    public function index()
    {
        // Cek Role user
        $role = session()->get('role');
        $data = [
            'title'                    => 'Dashboard',
            'total_surat_masuk_klien'  => $this->suratMasukModel->total_surat_masuk_klien(),
            'total_surat_keluar_klien' => $this->suratKeluarModel->total_surat_keluar_klien(),
            'total_surat_masuk'        => $this->suratMasukModel->total_surat_masuk(),
            'total_surat_keluar'       => $this->suratKeluarModel->total_surat_keluar(),
            'total_user_aktif'         => $this->userModel->total_user_aktif(),
            'total_user_nonaktif'      => $this->userModel->total_user_nonaktif(),
            'total_karyawan'           => $this->karyawanModel->total_karyawan(),
            'total_klien'              => $this->klienModel->total_klien(),
            'total_produk'             => $this->produkModel->total_produk()
        ];

        // Pastikan kita memeriksa role sebelum melanjutkan
        if (!$role) {
            return redirect()->to('/'); // Redirect jika role tidak ada
        }

        switch ($role) {
            case 'superadmin':
                return view('home/superadmin', $data);
            case 'klien':
                return view('home/klien', $data);
            case 'sekretaris':
                return view('home/sekretaris', $data);
            case 'kadiv':
                return view('home/kadiv', $data);
            case 'dirops':
                return view('home/dirops', $data);
            case 'dirut':
                return view('home/dirut', $data);
            case 'staf':
                return view('home/staf', $data);
            default:
                return redirect()->to('/'); // Redirect jika role tidak dikenal
        }
    }
}

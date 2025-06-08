<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Cek Role user
        $role = session()->get('role');
        // $data = [
        //     'title' => 'Dashboard',
        //     'surat_masuk' => $this->suratMasukModel->total_surat_masuk(),
        //     'surat_masuk_dirut' => $this->suratMasukModel->total_surat_masuk_dirut(),
        //     'surat_masuk_dirops' => $this->suratMasukModel->total_surat_masuk_dirops(),
        //     'surat_keluar_dirops' => $this->suratKeluarModel->total_surat_keluar_dirops(),
        //     'surat_masuk_klien' => $this->suratKeluarModel->total_surat_masuk_klien(),
        //     'surat_keluar_klien' => $this->suratMasukModel->total_surat_keluar_klien(),
        //     'surat_keluar' => $this->suratKeluarModel->total_surat_keluar(),
        //     'disposisi_masuk' => $this->disposisiModel->total_disposisi(),
        //     'arsip' => $this->arsipModel->total_arsip(),
        //     'disposal' => $this->arsipModel->total_disposal(),
        //     'perusahaan' => $this->perusahaanModel->total_perusahaan(),
        //     'klien' => $this->klienModel->total_klien(),
        //     'produk' => $this->produkModel->total_produk(),
        //     'karyawan' => $this->karyawanModel->total_karyawan()

        // ];
        $data = [
            'title' => 'Dashboard',
        ];

        // Pastikan kita memeriksa role sebelum melanjutkan
        if (!$role) {
            return redirect()->to('/'); // Redirect jika role tidak ada
        }

        switch ($role) {
            case 'superadmin':
                return view('home/superadmin', $data);
            case 'klien':
                return view('home/user');
            case 'sekretaris':
                return view('home/sekretaris', $data);
            case 'kadiv':
                return view('home/kadiv');
            case 'dirops':
                return view('home/dirops');
            case 'dirut':
                return view('home/dirut');
            case 'staf':
                return view('home/staf');
            default:
                return redirect()->to('/'); // Redirect jika role tidak dikenal
        }
    }
}

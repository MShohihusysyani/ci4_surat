<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    protected $suratMasukModel, $suratKeluarModel, $klienModel;
    public function __construct()
    {
        $this->suratMasukModel  = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->klienModel       = new KlienModel();
    }
    public function surat_masuk()
    {
        $data = [
            'title'  => 'Laporan Surat Masuk',
            'kliens' => $this->klienModel->getAllKlien(),
        ];
        return view('laporan/surat_masuk', $data);
    }

    public function ajax_surat_masuk()
    {
        $request = service('request');

        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        // Ambil filter tambahan dari form (pastikan name filter di form sesuai)
        $tgl_awal   = $request->getPost('tanggal_awal');       // sama dengan di view
        $tgl_akhir  = $request->getPost('tanggal_akhir');
        $nama_klien = $request->getPost('nama_klien');
        $progres    = $request->getPost('progres');

        // Panggil method model yang sudah kamu buat dengan parameter filter
        $data = $this->suratMasukModel->getDatatablesFiltered(
            $start,
            $length,
            $search,
            $tgl_awal,
            $tgl_akhir,
            $nama_klien,
            $progres,
        );

        $recordsTotal    = $this->suratMasukModel->countAll();
        $recordsFiltered = $this->suratMasukModel->countFilteredFiltered(
            $search,
            $tgl_awal,
            $tgl_akhir,
            $nama_klien,
            $progres,
        );

        $results = [];
        $no = $start + 1;

        foreach ($data as $row) {
            $aksi = '<ul class="action">
                        <li class="history">
                            <a href="' . site_url('/riwayat/riwayat_surat_masuk/' . $row->id_surat_masuk) . '">
                                <i class="icon-arrow-circle-left"></i>
                            </a>
                        </li>
                    </ul>';
            $results[] = [
                'no'            => $no++,
                'tgl_terima'    => tanggal_indo($row->tgl_terima),
                'file'          => formatFilePreview($row->file, $row->id_surat_masuk),
                'no_surat'      => esc($row->no_surat),
                'perihal'       => esc($row->perihal),
                'nama_klien'    => esc($row->nama_klien),
                'status_surat'  => formatStatusSurat($row->status_surat),
                'progres_surat' => formatProgresSurat($row->progres_surat),
                'status_balas'  => formatStatusBalas($row->butuh_balas, $row->status_balas),
                'aksi'          => $aksi,
            ];
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $results,
        ]);
    }

    public function surat_keluar()
    {
        $data = [
            'title'  => 'Laporan Surat Keluar',
        ];
        return view('laporan/surat_keluar', $data);
    }

    public function ajax_surat_keluar()
    {
        $request = service('request');

        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        // Ambil filter tambahan dari form (pastikan name filter di form sesuai)
        $tgl_awal   = $request->getPost('tanggal_awal');       // sama dengan di view
        $tgl_akhir  = $request->getPost('tanggal_akhir');
        $nama_klien = $request->getPost('nama_klien');
        $progres    = $request->getPost('progres');

        // Panggil method model yang sudah kamu buat dengan parameter filter
        $data = $this->suratKeluarModel->getDatatablesFiltered(
            $start,
            $length,
            $search,
            $tgl_awal,
            $tgl_akhir,
            $nama_klien,
            $progres,
        );

        $recordsTotal    = $this->suratKeluarModel->countAll();
        $recordsFiltered = $this->suratKeluarModel->countFilteredFiltered(
            $search,
            $tgl_awal,
            $tgl_akhir,
            $nama_klien,
            $progres,
        );

        $results = [];
        $no = $start + 1;

        foreach ($data as $row) {
            $results[] = [
                'no'            => $no++,
                'created_at'    => tanggal_indo($row->created_at),
                'no_surat'      => esc($row->no_surat),
                'tgl_surat'     => tanggal_indo($row->tgl_surat),
                'perihal'       => esc($row->perihal),
                // 'nama_klien'    => esc($row->nama_klien),
                'progres'       => formatProgresSuratKeluar($row->progres),
                'aksi'          => formatAksiSuratKeluar($row),
            ];
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $results,
        ]);
    }
}

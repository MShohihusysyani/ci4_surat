<?php

namespace App\Controllers\Sekretaris;

use App\Models\UserModel;
use App\Models\SuratMasukModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'users' => $this->userModel->getKadiv(),
        ];

        return view('sekretaris/surat_masuk/index', $data);
    }

    public function ajax_surat_masuk()
    {
        $request = service('request');
        $model = new SuratMasukModel();
        $list = $model->getDataTablesResult();
        $data = [];
        $no = $request->getPost('start');

        foreach ($list as $row) {
            $no++;

            $data[] = [
                'no'            => $no,
                'tgl_terima'    => tanggal_indo($row->tgl_terima),
                'file'          => formatFilePreview($row->file, $row->id_surat_masuk),
                'nama_klien'    => $row->nama_klien,
                'no_surat'      => '<a href="#" class="lihat-komentar" data-toggle="modal" data-target="#komentarModal" data-id="' . $row->id_surat_masuk . '">' . $row->no_surat . '</a>',
                'perihal'       => $row->perihal,
                'status_surat'  => formatStatusSurat($row->status_surat),
                'progres_surat' => formatProgresSurat($row->progres_surat),
                'status_balas'  => formatStatusBalas($row->butuh_balas, $row->status_balas),
                'handler_surat' => $row->handler_surat,
                'tags'          => $row->tags,
                'aksi'          => formatAksiSuratMasuk($row),
            ];
        }

        return $this->response->setJSON([
            "draw" => intval($request->getPost('draw')),
            "recordsTotal" => $model->countAllData(),
            "recordsFiltered" => $model->countFiltered(),
            "data" => $data,
        ]);
    }
}

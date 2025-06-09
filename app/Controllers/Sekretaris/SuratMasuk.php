<?php

namespace App\Controllers\Sekretaris;

use App\Models\UserModel;
use App\Models\SuratMasukModel;
use App\Controllers\BaseController;
use App\Models\DisposisiKadivModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $userModel, $disposisiModel;
    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->userModel       = new UserModel();
        $this->disposisiModel  = new DisposisiKadivModel();
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

    public function disposisi_kadiv()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namakadiv' => [
                'label' => 'Kadiv',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kadiv wajib diisi.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('alert', 'Kolom Kadiv wajib diisi.');
            return redirect()->to(base_url('/surat-masuk'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namakadiv');

        // Ambil data user dari database
        $user = $this->userModel->find($id_user);

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/surat-masuk'));
        }

        $nama_user = $user->nama_user;

        // Insert ke tabel disposisi_kadiv;
        $this->disposisiModel->insert([
            'surat_masuk_id' => $id_surat,
            'user_id'        => $id_user,
        ]);


        // Update surat masuk dengan nama Kadiv
        $this->suratMasukModel->disposisiKeKadiv($id_surat, $nama_user);


        session()->setFlashdata('pesan', 'Berhasil disposisi!');
        return redirect()->to(base_url('/surat-masuk'));
    }
}

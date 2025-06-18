<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\ProdukModel;
use App\Models\PerusahaanModel;
use App\Models\SuratMasukModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $klienModel, $perusahaanModel, $produkModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->klienModel      = new KlienModel();
        $this->perusahaanModel = new PerusahaanModel();
        $this->produkModel     = new ProdukModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'suratmasuks' => $this->suratMasukModel->getSuratByUser(),
        ];

        return view('surat_masuk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'       => 'Tambah Surat Masuk',
            'kliens'      => $this->klienModel->getAllKlien(),
            'perusahaans' => $this->perusahaanModel->findAll(),
            'produks'     => $this->produkModel->findAll(),
        ];
        return view('surat_masuk/tambah', $data);
    }

    public function simpan()
    {
        // Validasi hanya untuk username (wajib & unik)
        $validationRules = [
            'file' => [
                'label' => 'file',
                'rules' => 'uploaded[file]|max_size[file,25600]|mime_in[file,image/jpeg,image/jpg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diunggah.',
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in' => '{field} harus berupa  jpeg/jpg/png/pdf.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            // Ambil semua error dan kirim ke flashdata
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            session()->setFlashdata('validation_errors', $errors);
            session()->setFlashdata('swal_error', 'Data gagal ditambahkan!');

            return redirect()->to('/suratmasuk/tambah')->withInput();
        }

        //Upload file
        $file = $this->request->getFile('file');
        $nama_file = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $nama_file = $file->getRandomName();
            $file->move('file/surat_masuk', $nama_file);
        }

        try {
            $id_user = session()->get('id_user');
            $data = [
                'tgl_surat'       => $this->request->getPost('tgl_surat'),
                'no_surat'        => $this->request->getPost('no_surat'),
                'perihal'         => $this->request->getPost('perihal'),
                'tgl_terima'      => $this->request->getPost('tgl_terima'),
                'klien_id'        => $this->request->getPost('klien_id'),
                'surat_dari'      => $this->request->getPost('surat_dari'),
                'tujuan_surat'    => $this->request->getPost('tujuan_surat'),
                'perusahaan'      => $this->request->getPost('perusahaan'),
                'produk'          => implode(', ', $this->request->getPost('produk')),
                'prioritas_surat' => $this->request->getPost('prioritas_surat'),
                'butuh_balas'     => $this->request->getPost('butuh_balas'),
                'file'            => $nama_file,
                'user_id_input'   => $id_user
            ];

            $this->suratMasukModel->insert($data);


            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            // dd($th)->getMessage();
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/suratmasuk');
    }

    public function edit($id)
    {
        $data = [
            'title'       => 'Edit Surat Masuk',
            'suratmasuks'  => $this->suratMasukModel->getSuratById($id),
            'kliens'      => $this->klienModel->getAllKlien(),
            'perusahaans' => $this->perusahaanModel->findAll(),
            'produks'     => $this->produkModel->findAll(),
        ];
        return view('surat_masuk/edit', $data);
    }

    public function update($id)
    {
        $surat = $this->suratMasukModel->find($id);

        // Aturan validasi
        $validationRules = [

            // Validasi opsional untuk file foto
            'foto' => [
                'label' => 'Foto',
                'rules' => 'if_exist|max_size[foto,25600]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in' => '{field} harus berupa JPG, JPEG, atau PNG.'
                ]
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation_errors', $this->validator);
        }

        // Data input dasar
        $data = [
            'tgl_surat'       => $this->request->getPost('tgl_surat'),
            'no_surat'        => $this->request->getPost('no_surat'),
            'perihal'         => $this->request->getPost('perihal'),
            'tgl_terima'      => $this->request->getPost('tgl_terima'),
            'klien_id'        => $this->request->getPost('klien_id'),
            'surat_dari'      => $this->request->getPost('surat_dari'),
            'prioritas_surat' => $this->request->getPost('prioritas_surat'),
            'butuh_balas'     => $this->request->getPost('butuh_balas'),
            'tujuan_surat'    => $this->request->getPost('tujuan_surat'),
            'perusahaan'      => $this->request->getPost('perusahaan'),
            // 'produk'          => implode(', ', $this->request->getPost('produk')),
        ];


        // Handle foto
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if ($surat->file && file_exists(FCPATH . 'file/surat_masuk/' . $surat->file)) {
                unlink(FCPATH . 'file/surat_masuk/' . $surat->file);
            }

            // Simpan foto baru
            $new_file = $file->getRandomName();
            $file->move('file/surat_masuk', $new_file);
            $data['file'] = $new_file;
        } else {
            // Tetap gunakan file lama jika tidak upload baru
            $data['file'] = $surat->file;
        }

        // Simpan ke database
        $this->suratMasukModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data berhasil dirubah');
        return redirect()->to('/suratmasuk');
    }

    public function hapus($id)
    {
        $surat = $this->suratMasukModel->find($id);
        $file = $surat->file;
        if ($file && file_exists(FCPATH . 'file/surat_masuk/' . $file)) {
            unlink(FCPATH . 'file/surat_masuk/' . $file);
        }
        $this->suratMasukModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/suratmasuk');
    }
}

<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PerusahaanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    protected $produkModel, $perusahaanModel;

    public function __construct()
    {
        $this->produkModel     = new ProdukModel();
        $this->perusahaanModel = new PerusahaanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'produks' => $this->produkModel->findAll(),
            'perusahaans' => $this->perusahaanModel->findAll(),
        ];

        return view('kelola/produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk',
            'perusahaans' => $this->perusahaanModel->findAll(),
        ];

        return view('kelola/produk/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->request->getFile('logo_produk');

        // Validasi manual hanya untuk file, jika ada upload
        $validationRules = [];

        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['logo_produk'] = [
                'label' => 'Foto',
                'rules' => 'max_size[logo_produk,25600]|mime_in[logo_produk,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in'  => '{field} harus berupa gambar jpeg/jpg/png.'
                ]
            ];
        }

        // Hanya validasi jika ada aturan
        if (!empty($validationRules) && !$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            session()->setFlashdata('validation_errors', $errors);
            session()->setFlashdata('swal_error', 'Data gagal ditambahkan!');
            return redirect()->to('/kelola/produk/tambah')->withInput();
        }

        // Simpan gambar jika ada
        $namaFile = null;
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/logo_produk', $namaFile);
        }

        try {
            $this->produkModel->save([
                'nama_produk'   => $this->request->getPost('nama_produk'),
                'deskripsi'     => $this->request->getPost('deskripsi'),
                'perusahaan'    => $this->request->getPost('perusahaan'),
                'status_produk' => $this->request->getPost('status_produk'),
                'logo_produk'   => $namaFile, // null kalau tidak upload
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/kelola/produk');
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Produk',
            'produks'  => $this->produkModel->getProduk($id),
            'perusahaans' => $this->perusahaanModel->findAll(),
        ];

        return view('kelola/produk/edit', $data);
    }

    public function update($id)
    {
        $produkLama = $this->produkModel->find($id);
        $foto       = $this->request->getFile('logo_produk');
        $validationRules = [];

        // Validasi hanya jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['logo_produk'] = [
                'label' => 'Foto',
                'rules' => 'max_size[logo_produk,25600]|mime_in[logo_produk,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'max_size' => '{field} maksimal 25MB.',
                    'mime_in'  => '{field} harus berupa gambar jpeg/jpg/png.'
                ]
            ];
        }

        // Jalankan validasi jika ada
        if (!empty($validationRules) && !$this->validate($validationRules)) {
            $errors = \Config\Services::validation()->getErrors();
            session()->setFlashdata('validation_errors', $errors);
            session()->setFlashdata('swal_error', 'Data gagal diperbarui!');
            return redirect()->to('/kelola/produk/edit/' . $id)->withInput();
        }

        $namaFile = $produkLama->logo_produk; // Default: pakai logo lama

        // Jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            // Hapus logo lama (jika ada)
            if (!empty($produkLama->logo_produk) && file_exists(FCPATH . 'assets/img/logo_produk/' . $produkLama->logo_produk)) {
                unlink(FCPATH . 'assets/img/logo_produk/' . $produkLama->logo_produk);
            }

            // Simpan logo baru
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/logo_produk', $namaFile);
        }

        try {
            $this->produkModel->update($id, [
                'nama_produk'   => $this->request->getPost('nama_produk'),
                'deskripsi'     => $this->request->getPost('deskripsi'),
                'perusahaan'    => $this->request->getPost('perusahaan'),
                'status_produk' => $this->request->getPost('status_produk'),
                'logo_produk'   => $namaFile,
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/kelola/produk');
    }

    public function hapus($id)
    {
        try {
            $produk = $this->produkModel->find($id);
            if ($produk && $produk->logo_produk) {
                $logoPath = 'assets/img/logo_produk/' . $produk->logo_produk;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $this->produkModel->delete($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            session()->setFlashdata('alert', 'Data gagal dihapus.');
            // log_message('error', 'Gagal menghapus produk: ' . $th->getMessage());
        }
        return redirect()->to('kelola/produk');
    }
    public function get_produk_by_perusahaan()
    {
        if ($this->request->isAJAX()) {
            $perusahaan = $this->request->getPost('perusahaan');

            $data = $this->produkModel->getProdukByPerusahaan($perusahaan);

            return $this->response->setJSON($data); // Kirim JSON response
        }
    }
}

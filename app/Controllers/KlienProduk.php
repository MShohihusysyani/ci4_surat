<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\ProdukModel;
use App\Models\KlienProdukModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KlienProduk extends BaseController
{
    protected $klienProdukModel, $klienModel, $produkModel;
    public function __construct()
    {
        $this->klienProdukModel = new KlienProdukModel();
        $this->klienModel       = new KlienModel();
        $this->produkModel      = new ProdukModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Klien Produk',
            'produks' => $this->klienProdukModel->findAll(),
        ];

        return view('kelola/klien_produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'   => 'Tambah Data Klien Produk',
            'produks' => $this->produkModel->findAll(),
            'kliens'  => $this->klienModel->findAll(),
        ];

        return view('kelola/klien_produk/tambah', $data);
    }

    public function simpan()
    {
        $data = [
            'no_klien'        => $this->request->getPost('no_klien'),
            'nama_klien'      => $this->request->getPost('nama_klien'),
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'tgl_pakai'       => $this->request->getPost('tgl_pakai'),
            'tgl_jatuh_tempo' => $this->request->getPost('tgl_jatuh_tempo'),
            'jangka_waktu'    => $this->request->getPost('jangka_waktu'),
            'biaya_setup'     => $this->request->getPost('biaya_setup'),
            'biaya_bulanan'   => $this->request->getPost('biaya_bulanan'),
            'biaya_cloud'     => $this->request->getPost('biaya_cloud'),
            'share_fee'       => $this->request->getPost('share_fee'),
        ];

        if ($this->klienProdukModel->insert($data)) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan.');
        } else {
            session()->setFlashdata('alert', 'Gagal menyimpan data.');
        }

        return redirect()->to('/kelola/klien-produk');
    }

    public function edit($id)
    {

        $data = [
            'title'         => 'Edit Data Klien Produk',
            'klien_produks' => $this->klienProdukModel->getKlienProduk($id),
            'produks'       => $this->produkModel->findAll(),
            'kliens'        => $this->klienModel->findAll(),
        ];

        return view('kelola/klien_produk/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'no_klien'        => $this->request->getPost('no_klien'),
            'nama_klien'      => $this->request->getPost('nama_klien'),
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'tgl_pakai'       => $this->request->getPost('tgl_pakai'),
            'tgl_jatuh_tempo' => $this->request->getPost('tgl_jatuh_tempo'),
            'jangka_waktu'    => $this->request->getPost('jangka_waktu'),
            'biaya_setup'     => $this->request->getPost('biaya_setup'),
            'biaya_bulanan'   => $this->request->getPost('biaya_bulanan'),
            'biaya_cloud'     => $this->request->getPost('biaya_cloud'),
            'share_fee'       => $this->request->getPost('share_fee'),
        ];

        if ($this->klienProdukModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        } else {
            session()->setFlashdata('alert', 'Gagal memperbarui data.');
        }

        return redirect()->to('/kelola/klien-produk');
    }

    public function hapus($id)
    {
        $this->klienProdukModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kelola/klien-produk');
    }

    public function getNamaKlien($no_klien)
    {
        $klienModel = new KlienModel();
        $klien = $klienModel->where('no_klien', $no_klien)->first();

        if ($klien) {
            // Akses nama_klien sebagai properti objek
            return $this->response->setJSON(['nama_klien' => $klien->nama_klien]);
        } else {
            return $this->response->setJSON(['nama_klien' => '']);
        }
    }

    public function getDeskripsiProduk($nama_produk)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->where('nama_produk', $nama_produk)->first();

        if ($produk) {
            // Akses nama_klien sebagai properti objek
            return $this->response->setJSON(['deskripsi' => $produk->deskripsi]);
        } else {
            return $this->response->setJSON(['deskripsi' => '']);
        }
    }
}

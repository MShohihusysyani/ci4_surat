<?php

namespace App\Controllers;

use App\Models\DatiModel;
use App\Models\WilayahModel;
use App\Models\PerusahaanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Perusahaan extends BaseController
{
    protected $perusahaanModel, $wilayahModel, $datiModel;

    public function __construct()
    {
        $this->perusahaanModel = new PerusahaanModel();
        $this->wilayahModel    = new WilayahModel();
        $this->datiModel       = new DatiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Perusahaan',
            'perusahaans' => model('PerusahaanModel')->findAll(),
        ];

        return view('kelola/perusahaan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'    => 'Tambah Perusahaan',
            'provinsi' => $this->wilayahModel->findAll(),
            'dati2'    => $this->datiModel->findAll(),
        ];

        return view('kelola/perusahaan/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->request->getFile('logo');

        // Validasi manual hanya untuk file, jika ada upload
        $validationRules = [];

        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['logo'] = [
                'label' => 'Logo',
                'rules' => 'max_size[logo,25600]|mime_in[logo,image/jpeg,image/jpg,image/png]',
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
            return redirect()->to('/kelola/perusahaan/tambah')->withInput();
        }

        // Simpan gambar jika ada
        $namaFile = null;
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/logo_perusahaan', $namaFile);
        }

        try {
            $this->perusahaanModel->save([
                'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
                'npwp'              => $this->request->getPost('npwp'),
                'alamat'            => $this->request->getPost('alamat'),
                'provinsi'          => $this->request->getPost('provinsi'),
                'kabupaten'         => $this->request->getPost('kabupaten'),
                'kecamatan'         => $this->request->getPost('kecamatan'),
                'kelurahan'         => $this->request->getPost('kelurahan'),
                'kode_pos'          => $this->request->getPost('kode_pos'),
                'dati2'             => $this->request->getPost('dati2'),
                'no_telp'           => $this->request->getPost('no_telp'),
                'email'             => $this->request->getPost('email'),
                'website'           => $this->request->getPost('website'),
                'instagram'         => $this->request->getPost('instagram'),
                'facebook'          => $this->request->getPost('facebook'),
                'youtube'           => $this->request->getPost('youtube'),
                'twitter'           => $this->request->getPost('twitter'),
                'tiktok'            => $this->request->getPost('tiktok'),
                'logo'              => $namaFile, // null kalau tidak upload
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/kelola/perusahaan');
    }

    public function edit($id)
    {
        $perusahaans = $this->perusahaanModel->getPerusahaan($id);

        $data = [
            'title'       => 'Edit Perusahaan',
            'perusahaans' => $perusahaans,
            'provinsi'  => $this->wilayahModel->getProvinsi(), // ambil daftar provinsi
            'kabupaten' => $this->wilayahModel->getKabupatenByProvinsi2($perusahaans['provinsi']), // ambil daftar kabupaten sesuai provinsi klien
            'kecamatan' => $this->wilayahModel->getKecamatanByKabupaten2($perusahaans['kabupaten']), // ambil daftar kecamatan sesuai kabupaten klien
            'kelurahan' => $this->wilayahModel->getKelurahanByKecamatan2($perusahaans['kecamatan']), // ambil daftar kelurahan sesuai kecamatan klien
            'kodepos'   => $this->wilayahModel->getKodeposByKelurahan($perusahaans['kelurahan']),
            'dati2'     => $this->datiModel->getDati(),
        ];

        return view('kelola/perusahaan/edit', $data);
    }

    public function update($id)
    {
        $perusahaanLama = $this->perusahaanModel->find($id);
        $foto       = $this->request->getFile('logo');
        $validationRules = [];

        // Validasi hanya jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['logo'] = [
                'label' => 'Foto',
                'rules' => 'max_size[logo,25600]|mime_in[logo,image/jpeg,image/jpg,image/png]',
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
            return redirect()->to('/kelola/perusahaan/edit/' . $id)->withInput();
        }

        $namaFile = $perusahaanLama->logo; // Default: pakai logo lama

        // Jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            // Hapus logo lama (jika ada)
            if (!empty($perusahaanLama->logo) && file_exists(FCPATH . 'assets/img/logo_perusahaan/' . $perusahaanLama->logo)) {
                unlink(FCPATH . 'assets/img/logo_perusahaan/' . $perusahaanLama->logo);
            }

            // Simpan logo baru
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/logo_perusahaan', $namaFile);
        }

        try {
            $this->perusahaanModel->update($id, [
                'nama_perusahaan'  => $this->request->getPost('nama_perusahaan'),
                'alamat'           => $this->request->getPost('alamat'),
                'provinsi'         => $this->request->getPost('provinsi'),
                'kabupaten'        => $this->request->getPost('kabupaten'),
                'kecamatan'        => $this->request->getPost('kecamatan'),
                'kelurahan'        => $this->request->getPost('kelurahan'),
                'kode_pos'         => $this->request->getPost('kode_pos'),
                'dati2'            => $this->request->getPost('dati2'),
                'no_telp'          => $this->request->getPost('no_telp'),
                'email'            => $this->request->getPost('email'),
                'website'          => $this->request->getPost('website'),
                'instagram'        => $this->request->getPost('instagram'),
                'facebook'         => $this->request->getPost('facebook'),
                'youtube'          => $this->request->getPost('youtube'),
                'twitter'          => $this->request->getPost('twitter'),
                'tiktok'           => $this->request->getPost('tiktok'),
                'logo'             => $namaFile,
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/kelola/perusahaan');
    }

    public function hapus($id)
    {
        try {
            $perusahaan = $this->perusahaanModel->find($id);
            if ($perusahaan && $perusahaan->logo) {
                $logoPath = 'assets/img/logo_perusahaan/' . $perusahaan->logo;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $this->perusahaanModel->delete($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            session()->setFlashdata('alert', 'Data gagal dihapus.');
            // log_message('error', 'Gagal menghapus produk: ' . $th->getMessage());
        }
        return redirect()->to('kelola/perusahaan');
    }
}

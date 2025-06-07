<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use App\Models\PerusahaanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Karyawan extends BaseController
{
    protected $karyawanModel, $jabatanModel, $perusahaanModel;
    public function __construct()
    {
        $this->karyawanModel   = new KaryawanModel();
        $this->jabatanModel    = new JabatanModel();
        $this->perusahaanModel = new PerusahaanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawans' => $this->karyawanModel->getData(),

        ];

        return view('kelola/karyawan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'       => 'Tambah Karyawan',
            'jabatans'    => $this->jabatanModel->findAll(),
            'perusahaans' => $this->perusahaanModel->findAll(),
        ];

        return view('kelola/karyawan/tambah', $data);
    }

    public function simpan()
    {
        $foto = $this->request->getFile('foto');

        // Validasi manual hanya untuk file, jika ada upload
        $validationRules = [];

        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['foto'] = [
                'label' => 'Foto',
                'rules' => 'max_size[foto,25600]|mime_in[foto,image/jpeg,image/jpg,image/png]',
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
            return redirect()->to('/kelola/karyawan/tambah')->withInput();
        }

        // Simpan gambar jika ada
        $namaFile = null;
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/foto_karyawan', $namaFile);
        }

        try {
            $this->karyawanModel->save([
                'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
                'nama_panggilan' => $this->request->getPost('nama_panggilan'),
                'nip'            => $this->request->getPost('nip'),
                'nik'            => $this->request->getPost('nik'),
                'alamat'         => $this->request->getPost('alamat'),
                'tempat_lahir'   => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
                'no_hp'          => $this->request->getPost('no_hp'),
                'email'          => $this->request->getPost('email'),
                'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
                'jabatan_id'     => $this->request->getPost('jabatan_id'),
                'perusahaan_id'  => $this->request->getPost('perusahaan_id'),
                'foto'           => $namaFile, // null kalau tidak upload
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/kelola/karyawan');
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Karyawan',
            'karyawans'  => $this->karyawanModel->getKaryawan($id),
            'perusahaans' => $this->perusahaanModel->findAll(),
            'jabatans'    => $this->jabatanModel->findAll(),
        ];

        return view('kelola/karyawan/edit', $data);
    }

    public function update($id)
    {
        $foto_lama = $this->karyawanModel->find($id);
        $foto       = $this->request->getFile('foto');
        $validationRules = [];

        // Validasi hanya jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            $validationRules['foto'] = [
                'label' => 'Foto',
                'rules' => 'max_size[foto,25600]|mime_in[foto,image/jpeg,image/jpg,image/png]',
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
            return redirect()->to('/kelola/karyawan/edit/' . $id)->withInput();
        }

        $namaFile = $foto_lama->foto; // Default: pakai logo lama

        // Jika upload gambar baru
        if ($foto && $foto->isValid() && !$foto->hasMoved() && $foto->getSize() > 0) {
            // Hapus logo lama (jika ada)
            if (!empty($foto_lama->foto) && file_exists(FCPATH . 'assets/img/foto_karyawan/' . $foto_lama->foto)) {
                unlink(FCPATH . 'assets/img/foto_karyawan/' . $foto_lama->foto);
            }

            // Simpan logo baru
            $namaFile = $foto->getRandomName();
            $foto->move('assets/img/foto_karyawan', $namaFile);
        }

        try {
            $this->karyawanModel->update($id, [
                'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
                'nama_panggilan' => $this->request->getPost('nama_panggilan'),
                'nip'            => $this->request->getPost('nip'),
                'nik'            => $this->request->getPost('nik'),
                'alamat'         => $this->request->getPost('alamat'),
                'tempat_lahir'   => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
                'no_hp'          => $this->request->getPost('no_hp'),
                'email'          => $this->request->getPost('email'),
                'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
                'jabatan_id'     => $this->request->getPost('jabatan_id'),
                'perusahaan_id'  => $this->request->getPost('perusahaan_id'),
                'foto'   => $namaFile,
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            session()->setFlashdata('swal_error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/kelola/karyawan');
    }

    public function hapus($id)
    {
        try {
            $karyawan = $this->karyawanModel->find($id);
            if ($karyawan && $karyawan->foto) {
                $logoPath = 'assets/img/foto_karyawan/' . $karyawan->foto;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $this->karyawanModel->delete($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            session()->setFlashdata('alert', 'Data gagal dihapus.');
            // log_message('error', 'Gagal menghapus karyawan: ' . $th->getMessage());
        }
        return redirect()->to('kelola/karyawan');
    }
}

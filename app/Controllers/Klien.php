<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\WilayahModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Klien extends BaseController
{
    protected $klienModel, $wilayahModel;
    public function __construct()
    {
        $this->klienModel   = new KlienModel();
        $this->wilayahModel = new WilayahModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Klien',
            'kliens' => $this->klienModel->findAll(),
        ];

        return view('kelola/klien/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Klien',
            'provinsi' => $this->wilayahModel->findAll(),
        ];

        return view('kelola/klien/tambah', $data);
    }

    public function simpan()
    {
        // $valid = $this->validate([
        //     'nama_klien' => [
        //         'label' => 'Nama Klien',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} harus diisi.'
        //         ]
        //     ],
        //     'alamat' => [
        //         'label' => 'Alamat',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} harus diisi.'
        //         ]
        //     ],
        //     // Tambahkan validasi lainnya sesuai kebutuhan
        // ]);

        // if (!$valid) {
        //     $error = $this->validator->listErrors();
        //     session()->setFlashdata('alert', $error);

        //     return redirect()->back()->withInput();
        // }

        $data = [
            'no_klien'      => $this->request->getPost('no_klien'),
            'nama_klien'    => $this->request->getPost('nama_klien'),
            'jenis_klien'   => $this->request->getPost('jenis_klien'),
            'alamat'        => $this->request->getPost('alamat'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kabupaten'     => $this->request->getPost('kabupaten'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'kelurahan'     => $this->request->getPost('kelurahan'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'jml_cabang'    => $this->request->getPost('jml_cabang'),
            'nama_dirut'    => $this->request->getPost('nama_dirut'),
            'nama_dirops'   => $this->request->getPost('nama_dirops'),
            'no_hp_dirut'    => $this->request->getPost('no_hp_dirut'),
            'no_telp'       => $this->request->getPost('no_telp'),
            'no_hp_pic'      => $this->request->getPost('no_hp_pic'),
            'nama_pic'      => $this->request->getPost('nama_pic'),
            'email'         => $this->request->getPost('email'),
            'website'       => $this->request->getPost('website'),
            'tgl_bergabung' => $this->request->getPost('tgl_bergabung'),
            'status_klien'  => $this->request->getPost('status_klien'),
            'tgl_nonaktif'  => $this->request->getPost('tgl_nonaktif'),
        ];

        $this->klienModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/kelola/klien');
    }

    public function edit($id)
    {
        $kliens = $this->klienModel->getKlien($id);

        $data = [
            'title'     => 'Edit Klien',
            'kliens'    => $kliens,
            'provinsi' => $this->wilayahModel->getProvinsi(), // ambil daftar provinsi
            'kabupaten' => $this->wilayahModel->getKabupatenByProvinsi2($kliens['provinsi']), // ambil daftar kabupaten sesuai provinsi klien
            'kecamatan' => $this->wilayahModel->getKecamatanByKabupaten2($kliens['kabupaten']), // ambil daftar kecamatan sesuai kabupaten klien
            'kelurahan' => $this->wilayahModel->getKelurahanByKecamatan2($kliens['kecamatan']), // ambil daftar kelurahan sesuai kecamatan klien
            'kodepos' => $this->wilayahModel->getKodeposByKelurahan($kliens['kelurahan']),
        ];

        return view('kelola/klien/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'no_klien'      => $this->request->getPost('no_klien'),
            'nama_klien'    => $this->request->getPost('nama_klien'),
            'jenis_klien'   => $this->request->getPost('jenis_klien'),
            'alamat'        => $this->request->getPost('alamat'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kabupaten'     => $this->request->getPost('kabupaten'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'kelurahan'     => $this->request->getPost('kelurahan'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'jml_cabang'    => $this->request->getPost('jml_cabang'),
            'nama_dirut'    => $this->request->getPost('nama_dirut'),
            'no_hp_dirut'    => $this->request->getPost('no_hp_dirut'),
            'nama_dirops'   => $this->request->getPost('nama_dirops'),
            'nama_pic'      => $this->request->getPost('nama_pic'),
            'no_hp_pic'      => $this->request->getPost('no_hp_pic'),
            'no_telp'       => $this->request->getPost('no_telp'),
            'email'         => $this->request->getPost('email'),
            'website'       => $this->request->getPost('website'),
            'tgl_bergabung' => $this->request->getPost('tgl_bergabung'),
            'status_klien'  => $this->request->getPost('status_klien'),
            'tgl_nonaktif'  => $this->request->getPost('tgl_nonaktif'),
        ];


        $this->klienModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data berhasil dirubah.');
        return redirect()->to('/kelola/klien');
    }

    public function hapus($id)
    {
        $this->klienModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kelola/klien');
    }
}

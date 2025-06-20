<?php

namespace App\Controllers\Dirops;

use App\Models\UserModel;
use App\Models\SuratTugasModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DisposisiSuratTugasModel;

class SuratTugas extends BaseController
{
    protected $suratTugasModel, $disposisiSuratTugasModel, $userModel;
    public function __construct()
    {
        $this->suratTugasModel          = new SuratTugasModel();
        $this->disposisiSuratTugasModel = new DisposisiSuratTugasModel();
        $this->userModel                = new UserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Tugas',
            'surat_tugas' => $this->suratTugasModel->getSuratByUser(),
            'users' => $this->userModel->getDirut(),
        ];

        return view('dirops/surat_tugas/index', $data);
    }

    public function disposisi()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_tugas' => 'required',
            'namadirut' => [
                'label'  => 'Dirut',
                'rules'  => 'required',
                'errors' => ['required' => 'Dirut wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/dirops/surat-tugas'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_tugas');
        $id_user = $this->request->getPost('namadirut');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/dirops/surat-tugas'));
        }

        // Simpan atau update catatan;
        $status = $this->disposisiSuratTugasModel->simpanAtauUpdate($id_surat, $id_user, [
            'surat_tugas_id' => $id_surat,
            'user_id'        => $id_user,
        ]);

        // Update status surat masuk
        $this->suratTugasModel->disposisi($id_surat);

        // // Update kolom catatan_kadiv di surat_masuk
        // $this->suratMasukModel->updateCatatanKadiv($id_surat, $catatan_kadiv);

        // // Simpan riwayat
        // $this->riwayatSuratMasukModel->insert([
        //     'surat_masuk_id' => $id_surat,
        //     'status'         => $status,
        //     'keterangan'     => 'Kadiv ' . ($status === 'Updated' ? 'memperbarui' : 'memberikan') . ' catatan',
        //     'user_id'        => $id_user,
        //     'created_at'     => date('Y-m-d H:i:s')
        // ]);

        // kirim_notif_disposisi_surat_masuk($id_user, $id_surat);

        session()->setFlashdata('pesan', $status === 'Updated' ? 'Disposisi berhasil diperbarui!' : 'Berhasil disposisi!');
        return redirect()->to(base_url('/dirops/surat-tugas'));
    }
}

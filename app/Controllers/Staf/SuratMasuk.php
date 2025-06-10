<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\DisposisiBawahModel;
use App\Models\SuratMasukModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $disposisiBawahanModel;

    public function __construct()
    {
        $this->suratMasukModel       = new SuratMasukModel();
        $this->disposisiBawahanModel = new DisposisiBawahModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'suratmasuks' => $this->disposisiBawahanModel->getData(),
        ];

        return view('staf/surat_masuk/index', $data);
    }

    public function finish_surat()
    {

        $id_surat = $this->request->getPost('id_surat_masuk');
        // // Ambil detail surat masuk
        // $suratMasuk = $this->SuratMasukModel->find($id);

        // // Cek logika validasi berdasarkan kebutuhan balas
        // if ($suratMasuk->butuh_balas === 'Ya') {
        //     if ($suratMasuk->status_balas === 'belum dibalas') {
        //         session()->setFlashdata('alert', 'Gagal finish. Mohon informasikan ke sekretaris untuk balas surat');
        //         return redirect()->to('/staf/surat-masuk');
        //     }

        //     // Cek apakah ada surat keluar yang terkait
        //     $suratKeluar = $this->suratKeluarModel
        //         ->where('surat_masuk_id', $id)
        //         ->first();

        //     if (!$suratKeluar) {
        //         session()->setFlashdata('alert', 'Gagal finish. Surat keluar belum dibuat.');
        //         return redirect()->to('/staf/surat-masuk');
        //     }

        //     if ($suratKeluar['progress_surat'] !== 'Approve') {
        //         session()->setFlashdata('alert', 'Gagal finish. Balasan surat belum di approve.');
        //         return redirect()->to('/staf/surat-masuk');
        //     }
        // }
        // Validasi hanya catatan finish
        // Validasi input
        $valid = $this->validate([
            'catatan_finish' => [
                'label' => 'Catatan Finish',
                'rules' => 'required|min_length[50]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} harus memiliki minimal {param} karakter.',
                ],
            ],
        ]);

        if (!$valid) {
            $errorMessage = $this->validator->getError('catatan_finish');
            return redirect()->to('/staf/surat-masuk')
                ->with('alert', $errorMessage);
        }

        $data = [
            'catatan_finish' => $this->request->getPost('catatan_finish'),
            'progres_surat'  => 'Finish'
        ];

        $this->suratMasukModel->update($id_surat, $data);

        // $id_user = session()->get('id_user');

        // date_default_timezone_set('Asia/Jakarta');
        // $now = date('Y-m-d H:i:s');
        // $riwayatData = [
        //     'surat_masuk_id' => $id,
        //     'status' => 'Disposisi',
        //     'keterangan' => 'Staf menyelesaikan surat',
        //     'user_id' => $id_user,
        //     'created_at' => $now
        // ];
        // $this->riwayatSuratMasukModel->save($riwayatData);

        session()->setFlashdata('pesan', 'Berhasil Finish Surat');
        return redirect()->to('staf/surat-masuk');
    }
}

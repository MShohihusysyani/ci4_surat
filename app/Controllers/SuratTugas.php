<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KaryawanModel;
use App\Models\SuratTugasModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DisposisiSuratTugasModel;

class SuratTugas extends BaseController
{
    protected $suratTugasModel, $karyawanModel, $userModel, $disposisiSuratTugasModel;
    public function __construct()
    {
        $this->suratTugasModel          = new SuratTugasModel();
        $this->karyawanModel            = new KaryawanModel();
        $this->userModel                = new UserModel();
        $this->disposisiSuratTugasModel = new DisposisiSuratTugasModel();
    }
    public function index()
    {
        $data = [
            'title'       => 'Surat Tugas',
            'surat_tugas' => $this->suratTugasModel->findAll(),
            'users'       => $this->userModel->getDirops(),
        ];
        return view('kadiv/surat_tugas/index', $data);
    }

    public function generate_nomor_surat()
    {
        // Panggil model untuk generate nomor surat
        $nomor_surat = $this->suratTugasModel->generateNomorSurat();

        // Kembalikan sebagai response JSON
        return $this->response->setJSON(['no_surat' => $nomor_surat]);
    }

    public function tambah()
    {

        $data = [
            'title'     => 'Tambah Surat Tugas',
            'karyawans' => $this->karyawanModel->findAll()
        ];
        return view('kadiv/surat_tugas/tambah', $data);
    }

    public function simpan_draft()
    {
        // $user_id_input = session()->get('id_user');
        date_default_timezone_set('Asia/Jakarta');
        $created_at = date('Y-m-d H:i:s');
        // Debug data anggota
        $anggota = $this->request->getPost('anggota');
        // var_dump($anggota); // Untuk melihat data yang diterima

        if (empty($anggota)) {
            session()->setFlashdata('alert', 'Anggota wajib diisi');
            return redirect()->back()->withInput();
        }
        $data = [
            'no_surat'      => $this->request->getPost('no_surat'),
            'unit_kerja'    => $this->request->getPost('unit_kerja'),
            'tempat'        => $this->request->getPost('tempat'),
            'alamat'        => $this->request->getPost('alamat'),
            'tugas'         => $this->request->getPost('tugas'),
            'tgl_berangkat' => $this->request->getPost('tgl_berangkat'),
            'tgl_kembali'   => $this->request->getPost('tgl_kembali'),
            'lama_bertugas' => $this->request->getPost('lama_bertugas'),
            'jam_tugas'     => $this->request->getPost('jam_tugas'),
            'tgl_bertugas'  => $this->request->getPost('tgl_bertugas'),
            'lpj'           => $this->request->getPost('lpj'),
            'laporan'       => $this->request->getPost('laporan'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'anggota'       => implode(',', $anggota),  // Menyimpan anggota sebagai string yang dipisahkan koma
            'created_at'    => $created_at,
            'progres'       => 'proses draft',
            'jam_berangkat' => $this->request->getPost('jam_berangkat'),
            'jam_kembali'   => $this->request->getPost('jam_kembali')
        ];
        // dd($data);

        // Simpan ke database
        $this->suratTugasModel->insert($data);
        $draft_id = $this->suratTugasModel->insertID(); // Ambil ID surat yang baru

        // Simpan ID draft di session agar bisa digunakan di tahap selanjutnya
        session()->set('draft_id', $draft_id);

        return redirect()->to('kadiv/surat-tugas/pilih-template');
    }

    public function pilih_template()
    {
        $id_surat_tugas = session()->get('draft_id');
        $data = [
            'title' => 'Pilih Template',
            'id_surat_tugas' => $id_surat_tugas,
        ];
        return view('kadiv/surat_tugas/pilih_template', $data);
    }

    public function preview_template($template)
    {
        $id_surat_tugas = session()->get('draft_id');
        // Daftar template yang tersedia
        $allowedTemplates = ['tugas'];

        // Validasi apakah template ada dalam daftar
        if (!in_array($template, $allowedTemplates)) {
            return redirect()->to('pilih-template-baru')->with('error', 'Template tidak valid!');
        }

        $data = [
            'title' => 'Preview Template',
            'surattugas' => $this->suratTugasModel->find($id_surat_tugas),
            'template' => $template,
        ];

        // Load view sesuai template yang dipilih
        return view("kadiv/surat_tugas/preview_$template", $data);
    }

    public function preview()
    {
        $surat = session()->get('draft_id');

        // Data dari database
        $anggota = $this->suratTugasModel->anggota;

        // Memecah anggota menjadi array berdasarkan koma
        $anggota = [];  // Inisialisasi sebagai array kosong
        if ($anggota) {
            $anggota = explode(',', $anggota); // Memisahkan anggota berdasarkan koma
        }

        // Inisialisasi mPDF dengan pengaturan margin untuk header dan footer
        $mpdf = new \Mpdf\Mpdf([
            'format' => [210, 330], //format F4
            'margin_top' => 35,    // Margin atas untuk memberi ruang pada header 
        ]);

        // Mengatur header
        $mpdf->SetHTMLHeader("
    <table width='100%' style='font-family: Arial, sans-serif;'>
        <tr>
            <th rowspan='3'>
                <img src='assets/images/mso.png' style='height: 60px;' alt='Logo Perusahaan' />
            </th>
            <td>
                <h2>PT. Mitranet Software Online</h2>
                <p>IT Consultant & Software Development</p>
            </td>
        </tr>
    </table>
    <hr>
    ");


        // Mengatur footer
        $mpdf->SetHTMLFooter(" 
        <hr> 
        <table width='100%' style='font-size: 10px;'> 
            <tr> 
                <td style='text-align: left;'> 
                    Jalan Gerilya Tengah, Komplek Perum Griya Karang Indah Blok B4-5 Purwokerto, Jawa Tengah 53142 
                    <br>Telepon: (0281) 623 789 | Fax: (0281) 657 789 
                </td> 
                <td style='text-align: right;'></td> 
            </tr> 
        </table> 
    ");


        // Konten utama dokumen
        $html = view('cetak/preview_surat_tugas', [
            'surattugas' => $this->suratTugasModel->find($surat),
            'anggota' => $anggota
        ]);

        // Menulis konten ke dalam PDF
        $mpdf->WriteHTML($html);

        // Mengatur respons untuk menampilkan PDF di browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('', 'S'));
    }

    public function simpan_draft_final()
    {
        if ($this->request->isAJAX()) {
            $id   = $this->request->getPost('id_surat_tugas');

            $data = [
                'no_surat'      => $this->request->getPost('no_surat'),
                'unit_kerja'    => $this->request->getPost('unit_kerja'),
                'tempat'        => $this->request->getPost('tempat'),
                'alamat'        => $this->request->getPost('alamat'),
                'tugas'         => $this->request->getPost('tugas'),
                'tgl_berangkat' => $this->request->getPost('tgl_berangkat'),
                'jam_berangkat' => $this->request->getPost('jam_berangkat'),
                'jam_kembali'   => $this->request->getPost('jam_kembali'),
                'tgl_kembali'   => $this->request->getPost('tgl_kembali'),
                'lama_bertugas' => $this->request->getPost('lama_bertugas'),
                'jam_tugas'     => $this->request->getPost('jam_tugas'),
                'tgl_bertugas'  => $this->request->getPost('tgl_bertugas'),
                'lpj'           => $this->request->getPost('lpj'),
                'laporan'       => $this->request->getPost('laporan'),
                'keterangan'    => $this->request->getPost('keterangan'),
                'progres'       => 'draft',
                'status'        => 'belum dibaca',
            ];


            // Proses Update
            $update = $this->suratTugasModel->update($id, $data);

            // // Simpan riwayat surat keluar
            // $suratTugasId = $this->request->getPost('id');
            // $id_user = session()->get('id_user');
            // $nama_user = session()->get('nama_user');
            // $riwayatData = [
            //     'surat_tugas_id' => $suratTugasId,
            //     'status' => 'Created',
            //     'keterangan' => 'Sekretaris membuat surat tugas',
            //     'created_at' => $created_at,
            //     'user_id' => $id_user,
            // ];

            // $this->riwayatSuratTugasModel->save($riwayatData);

            // //LOG USER
            // $user_id = $id_user; // Ambil ID pengguna dari session
            // $details = $nama_user . ' membuat surat tugas dengan penugasan : ' . $this->request->getPost('tugas');
            // $action = 'create';

            // // Simpan log aktivitas
            // log_user($user_id, $action, $details);

            if ($update) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data!'
                ]);
            }
        }
    }

    public function edit($id)
    {
        $surattugas = $this->suratTugasModel->getSurat($id);
        // Anggota dipisahkan koma → jadi array

        $anggota = $this->suratTugasModel->anggota;
        $anggota = [];  // Inisialisasi sebagai array kosong
        if ($anggota) {
            $anggota = explode(',', $anggota); // Memisahkan anggota berdasarkan koma
        }
        $anggota_array = $anggota;



        $data = [
            'title'      => 'Edit Surat Tugas',
            'surattugas' => $surattugas,
            'karyawans'  => $this->karyawanModel->findAll(),
            'anggota_terpilih'    => $anggota_array
        ];

        return view('kadiv/surat_tugas/edit', $data);
    }

    public function update($id)
    {

        // $update = $this->suratTugasModel->find($id);
        $data = [
            'no_surat'      => $this->request->getPost('no_surat'),
            'anggota'       => implode(',', $this->request->getPost('anggota')),
            'unit_kerja'    => $this->request->getPost('unit_kerja'),
            'tempat'        => $this->request->getPost('tempat'),
            'alamat'        => $this->request->getPost('alamat'),
            'tugas'         => $this->request->getPost('tugas'),
            'tgl_berangkat' => $this->request->getPost('tgl_berangkat'),
            'jam_berangkat' => $this->request->getPost('jam_berangkat'),
            'jam_kembali'   => $this->request->getPost('jam_kembali'),
            'tgl_kembali'   => $this->request->getPost('tgl_kembali'),
            'lama_bertugas' => $this->request->getPost('lama_bertugas'),
            'jam_tugas'     => $this->request->getPost('jam_tugas'),
            'tgl_bertugas'  => $this->request->getPost('tgl_bertugas'),
            'lpj'           => $this->request->getPost('lpj'),
            'laporan'       => $this->request->getPost('laporan'),
            'keterangan'    => $this->request->getPost('keterangan'),

        ];

        $this->suratTugasModel->update($id, $data);
        return redirect()->to(base_url('kadiv/surat-tugas'))->with('pesan', 'Data berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $this->suratTugasModel->delete($id);
        return redirect()->to(base_url('kadiv/surat-tugas'))->with('pesan', 'Data berhasil dihapus!');
    }

    // Disposisi
    public function disposisi()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_tugas' => 'required',
            'namadirops' => [
                'label'  => 'Dirops',
                'rules'  => 'required',
                'errors' => ['required' => 'Dirops wajib diisi.']
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            session()->setFlashdata('alert', implode(' ', $errors));
            return redirect()->to(base_url('/kadiv/surat-tugas'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_tugas');
        $id_user = $this->request->getPost('namadirops');

        // Ambil user;
        $user = $this->userModel->find($id_user);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/kadiv/surat-tugas'));
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
        return redirect()->to(base_url('/kadiv/surat-tugas'));
    }
}

<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\KaryawanModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuratKeluar extends BaseController
{
    protected $suratKeluarModel, $klienModel, $karyawanModel;
    public function __construct()
    {
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->klienModel       = new KlienModel();
        $this->karyawanModel    = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Keluar',
            'suratkeluars' => $this->suratKeluarModel->getSuratByUser(),

        ];
        return view('surat_keluar/index', $data);
    }

    public function tambah()
    {

        $data = [
            'title' => 'Tambah Surat Keluar',
            'kliens' => $this->klienModel->getAllKlien(),
            'pejabats' => $this->karyawanModel->getPejabat(),
        ];
        return view('surat_keluar/tambah', $data);
    }

    public function simpan_draft()
    {
        $file_lampiran = $this->request->getFile('file_lampiran');
        $new_file_lampiran = null;

        // Jika file ada dan valid, lakukan pengecekan
        if ($file_lampiran && $file_lampiran->isValid() && !$file_lampiran->hasMoved()) {
            if ($file_lampiran->getSize() > 25600 * 1024) { // 25 MB
                session()->setFlashdata('alert', 'File terlalu besar. Maksimal 25 MB.');
                return redirect()->back()->withInput();
            }
            if (!in_array($file_lampiran->getMimeType(), [
                'application/pdf',
                'application/zip',
                'application/rar',
                'image/jpg',
                'image/jpeg',
                'image/png',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel'
            ])) {
                session()->setFlashdata('alert', 'Format file tidak valid. Hanya PDF, Excel, JPEG, JPG, PNG, ZIP, atau RAR.');
                return redirect()->back()->withInput();
            }

            // Simpan file
            $new_file_lampiran = $file_lampiran->getRandomName();
            $file_lampiran->move('file/surat_keluar/lampiran', $new_file_lampiran);
        }

        // Siapkan data (baik dengan atau tanpa file)
        $id_user = session()->get('id_user');
        $data = [
            'tgl_surat'     => $this->request->getPost('tgl_surat'),
            'no_surat'      => $this->request->getPost('no_surat'),
            'perihal'       => $this->request->getPost('perihal'),
            'lampiran'      => $this->request->getPost('lampiran'),
            'prioritas'     => $this->request->getPost('prioritas'),
            'klien_id'      => $this->request->getPost('klien_id'),
            'nama_klien'    => $this->request->getPost('nama_klien'),
            'tempat'        => $this->request->getPost('tempat'),
            'penerbit_id'   => $this->request->getPost('penerbit_id'),
            'file_lampiran' => $new_file_lampiran,
            'progres'       => 'proses draft',
            'user_id_input' => $id_user
        ];

        // Cek jika nomor surat sudah ada
        if ($this->suratKeluarModel->where('no_surat', $data['no_surat'])->first()) {
            session()->setFlashdata('alert', 'Nomor surat sudah ada!');
            return redirect()->back()->withInput();
        }

        $this->suratKeluarModel->insert($data);
        $draft_id = $this->suratKeluarModel->insertID();
        session()->set('draft_id', $draft_id);

        return redirect()->to('suratkeluar/pilih-template');
    }

    public function pilih_template()
    {
        $id_surat_keluar = session()->get('draft_id');
        $data = [
            'title' => 'Pilih Template',
            'id_surat_keluar' => $id_surat_keluar,
        ];
        return view('surat_keluar/pilih_template', $data);
    }

    public function preview_template($template)
    {
        $id_surat_keluar = session()->get('draft_id');
        // Daftar template yang tersedia
        $allowedTemplates = ['backdate', 'penawaran'];

        // Validasi apakah template ada dalam daftar
        if (!in_array($template, $allowedTemplates)) {
            return redirect()->to('pilih-template-baru')->with('error', 'Template tidak valid!');
        }

        $data = [
            'title' => 'Preview Template',
            'suratkeluar' => $this->suratKeluarModel->find($id_surat_keluar),
            'template' => $template,
        ];

        // Load view sesuai template yang dipilih
        return view("surat_keluar/preview_$template", $data);
    }

    public function preview_backdate()
    {
        $suratKeluarModel = new \App\Models\SuratKeluarModel();
        $karyawanModel    = new \App\Models\KaryawanModel();
        $surat = session()->get('draft_id');

        $suratkeluar = $suratKeluarModel->asArray()->find($surat);

        $penerbit = $karyawanModel
            ->select('karyawan.nama_lengkap, jabatan.nama_jabatan')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('karyawan.id_karyawan', $suratkeluar['penerbit_id'])
            ->first();

        // Inisialisasi mPDF dengan pengaturan margin untuk header dan footer
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 35,    // Margin atas untuk memberi ruang pada header 
            'margin_bottom' => 30, // Margin bawah untuk footer 
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

        // Ambil konten surat dari request POST (dari CKEditor)
        $data = $this->request->getJSON(true);
        $konten = $data['konten'];


        // Konten utama dokumen
        $html = view('cetak/preview_backdate', [
            'suratkeluar' => $suratkeluar,
            'konten' => $konten,
            'penerbit_nama'     => $penerbit->nama_lengkap ?? '',
            'penerbit_jabatan'  => $penerbit->nama_jabatan ?? '',
        ]);

        // Menulis konten ke dalam PDF
        $mpdf->WriteHTML($html);

        // Mengatur respons untuk menampilkan PDF di browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('', 'S'));
    }

    public function simpan_draft_final()
    {
        $suratKeluarModel = new SuratKeluarModel();
        date_default_timezone_set('Asia/Jakarta');
        $created_at = date('Y-m-d H:i:s');
        if ($this->request->isAJAX()) {
            $id_surat_keluar = $this->request->getPost('id_surat_keluar');

            $data = [
                'no_surat'       => $this->request->getPost('no_surat'),
                'tgl_surat'      => $this->request->getPost('tgl_surat'),
                'lampiran'       => $this->request->getPost('lampiran'),
                'perihal'        => $this->request->getPost('perihal'),
                'prioritas'      => $this->request->getPost('prioritas'),
                'tags'           => $this->request->getPost('tags'),
                'konten'         => $this->request->getPost('konten'),
                'progres'       => 'draft',
                'created_at'     => $created_at,
                'template'       => ($this->request->getPost('template') == 'pengumuman') ? 'pengumuman' : null // Hanya jika pengumuman
            ];;

            // Proses Update
            $update = $suratKeluarModel->update($id_surat_keluar, $data);

            // Simpan riwayat surat keluar
            // $suratKeluarId = $this->request->getPost('id');
            // $id_user = session()->get('id_user');
            // // $nama_user = session()->get('nama_user');
            // // $perihal = $this->request->getPost('perihal');

            // // Data untuk tabel riwayat_surat_keluar
            // $riwayatData = [
            //     'surat_keluar_id' => $suratKeluarId,
            //     'status' => 'Created',
            //     'keterangan' => 'Sekretaris membuat surat keluar',
            //     'created_at' => $created_at,
            //     'user_id' => $id_user,
            // ];

            // $this->riwayatSuratKeluarModel->save($riwayatData);

            // // Log user
            // $user_id = $id_user; // Ambil ID pengguna dari session
            // $details = $nama_user . ' membuat surat keluar dengan perihal: ' . $perihal;
            // $action = 'create';

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

        $data = [
            'title' => 'Edit Surat',
            'suratkeluars' => $this->suratKeluarModel->getSurat($id),
            'kliens' => $this->klienModel->getAllKlien(),
            'pejabats' => $this->karyawanModel->getPejabat(),
        ];

        return view('surat_keluar/edit', $data);
    }

    public function update($id)
    {
        $lampiran_lama   = $this->suratKeluarModel->find($id);
        $lampiran        = $this->request->getFile('file_lampiran');
        $validationRules = [];

        // Validasi hanya jika upload gambar baru
        if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved() && $lampiran->getSize() > 0) {
            $validationRules['file_lampiran'] = [
                'label' => 'Lampiran',
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
            return redirect()->to('/suratkeluar/edit/' . $id)->withInput();
        }

        $nama_file = $lampiran_lama->lampiran; // Default: pakai logo lama

        // Jika upload gambar baru
        if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved() && $lampiran->getSize() > 0) {
            // Hapus logo lama (jika ada)
            if (!empty($lampiran_lama->file_lampiran) && file_exists(FCPATH . 'file/surat_keluar/lampiran/' . $lampiran_lama->file_lampiran)) {
                unlink(FCPATH . 'file/surat_keluar/lampiran/' . $lampiran_lama->file_lampiran);
            }

            // Simpan logo baru
            $nama_file = $lampiran->getRandomName();
            $lampiran->move('file/surat_keluar/lampiran', $nama_file);
        }

        $data = [
            'no_surat'      => $this->request->getPost('no_surat'),
            'tgl_surat'     => $this->request->getPost('tgl_surat'),
            'perihal'       => $this->request->getPost('perihal'),
            'lampiran'      => $this->request->getPost('lampiran'),
            'prioritas'     => $this->request->getPost('prioritas'),
            'klien_id'      => $this->request->getPost('klien_id'),
            'tempat'        => $this->request->getPost('tempat'),
            'penerbit_id'   => $this->request->getPost('penerbit_id'),
            'konten'        => $this->request->getPost('konten'),
            'file_lampiran' => $nama_file,
            'progres'       => 'draft',

        ];

        $this->suratKeluarModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');

        return redirect()->to('/suratkeluar');
    }

    public function hapus($id)
    {
        $surat = $this->suratKeluarModel->find($id);
        $file = $surat->file_lampiran;
        if ($file && file_exists(FCPATH . 'file/surat_keluar/lampiran/' . $file)) {
            unlink(FCPATH . 'file/surat_keluar/lampiran/' . $file);
        }
        $this->suratKeluarModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/suratkeluar');
    }
}

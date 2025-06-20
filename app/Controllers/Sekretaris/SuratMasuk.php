<?php

namespace App\Controllers\Sekretaris;

use App\Models\UserModel;
use App\Models\KaryawanModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use App\Models\DisposisiKadivModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $suratMasukModel, $suratKeluarModel, $karyawanModel, $userModel, $disposisiModel;
    public function __construct()
    {
        $this->suratMasukModel  = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->karyawanModel    = new KaryawanModel();
        $this->userModel        = new UserModel();
        $this->disposisiModel   = new DisposisiKadivModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'users' => $this->userModel->getKadiv(),
        ];

        return view('sekretaris/surat_masuk/index', $data);
    }

    public function ajax_surat_masuk()
    {
        $request = service('request');
        $model = new SuratMasukModel();
        $list = $model->getDataTablesResult();
        $data = [];
        $no = $request->getPost('start');

        foreach ($list as $row) {
            $no++;

            $data[] = [
                'no'            => $no,
                'tgl_terima'    => tanggal_indo($row->tgl_terima),
                'file'          => formatFilePreview($row->file, $row->id_surat_masuk),
                'nama_klien'    => $row->nama_klien,
                'no_surat'      => '<a href="#" class="lihat-komentar" data-toggle="modal" data-target="#komentarModal" data-id="' . $row->id_surat_masuk . '">' . $row->no_surat . '</a>',
                'perihal'       => $row->perihal,
                'status_surat'  => formatStatusSurat($row->status_surat),
                'progres_surat' => formatProgresSurat($row->progres_surat),
                'status_balas'  => formatStatusBalas($row->butuh_balas, $row->status_balas),
                'handler_surat' => $row->handler_surat,
                'tags'          => $row->tags,
                'aksi'          => formatAksiSuratMasuk($row),
            ];
        }

        return $this->response->setJSON([
            "draw" => intval($request->getPost('draw')),
            "recordsTotal" => $model->countAllData(),
            "recordsFiltered" => $model->countFiltered(),
            "data" => $data,
        ]);
    }

    public function disposisi_kadiv()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_surat_masuk' => 'required',
            'namakadiv' => [
                'label' => 'Kadiv',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kadiv wajib diisi.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('alert', 'Kolom Kadiv wajib diisi.');
            return redirect()->to(base_url('/surat-masuk'))->withInput();
        }

        $id_surat = $this->request->getPost('id_surat_masuk');
        $id_user = $this->request->getPost('namakadiv');

        // Ambil data user dari database
        $user = $this->userModel->find($id_user);

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('/surat-masuk'));
        }

        $nama_user = $user->nama_user;

        // Insert ke tabel disposisi_kadiv;
        $this->disposisiModel->insert([
            'surat_masuk_id' => $id_surat,
            'user_id'        => $id_user,
        ]);


        // Update surat masuk dengan nama Kadiv
        $this->suratMasukModel->disposisiKeKadiv($id_surat, $nama_user);


        session()->setFlashdata('pesan', 'Berhasil disposisi!');
        return redirect()->to(base_url('/surat-masuk'));
    }

    public function balas($id)
    {
        $data = [
            'title' => 'Balas Surat',
            'suratmasuk' => $this->suratMasukModel->getBalas($id),
            'pejabats' => $this->karyawanModel->getPejabat(),
        ];
        return view('sekretaris/surat_masuk/balas', $data);
    }

    public function simpan_balasan()
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
        $data = [
            'tgl_surat'         => $this->request->getPost('tgl_surat'),
            'no_surat'          => $this->request->getPost('no_surat'),
            'nomor_surat_masuk' => $this->request->getPost('no_surat_masuk'),
            'perihal'           => $this->request->getPost('perihal'),
            'lampiran'          => $this->request->getPost('lampiran'),
            'prioritas'         => $this->request->getPost('prioritas'),
            'klien_id'          => $this->request->getPost('klien_id'),
            'nama_klien'        => $this->request->getPost('nama_klien'),
            'tempat'            => $this->request->getPost('tempat'),
            'penerbit_id'       => $this->request->getPost('penerbit_id'),
            'surat_masuk_id'    => $this->request->getPost('surat_masuk_id'),
            'file_lampiran'     => $new_file_lampiran,
            'progres'           => 'proses draft',
        ];

        // Cek jika nomor surat sudah ada
        if ($this->suratKeluarModel->where('no_surat', $data['no_surat'])->first()) {
            session()->setFlashdata('alert', 'Nomor surat sudah ada!');
            return redirect()->back()->withInput();
        }

        $this->suratKeluarModel->insert($data);
        $draft_id = $this->suratKeluarModel->insertID();

        // **Update status_balas di tabel surat_masuk menjadi "Sudah Dibalas"**
        $id_surat_masuk = $this->request->getPost('surat_masuk_id');
        if (!empty($id_surat_masuk)) {
            $this->suratMasukModel->update($id_surat_masuk, ['status_balas' => 'sudah dibalas']);
        }
        session()->set('draft_id', $draft_id);

        return redirect()->to('surat-masuk/pilih-template');
    }


    public function pilih_template()
    {
        $id_surat_keluar = session()->get('draft_id');
        $data = [
            'title' => 'Pilih Template',
            'id_surat_keluar' => $id_surat_keluar,
        ];
        return view('sekretaris/surat_masuk/pilih_template', $data);
    }

    public function preview_template($template)
    {
        $id_surat_keluar = session()->get('draft_id');
        // Daftar template yang tersedia
        $allowedTemplates = ['backdate', 'penawaran', 'pengumuman', 'sponsor', 'tugas'];

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
        return view("sekretaris/surat_keluar/preview_$template", $data);
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

    public function simpan_balasan_final()
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
}

<?php

namespace App\Controllers;

use Mpdf\Mpdf;
use Endroid\QrCode\QrCode;
use App\Models\KaryawanModel;
use App\Models\SuratMasukModel;
use App\Models\SuratTugasModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use Endroid\QrCode\Writer\PngWriter;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Export extends BaseController
{
    protected $suratMasukModel, $suratKeluarModel, $suratTugasModel, $karyawanModel;
    public function __construct()
    {
        $this->suratMasukModel  = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->suratTugasModel  = new SuratTugasModel();
        $this->karyawanModel    = new KaryawanModel();
    }

    public function export_backdate($id)
    {
        // Ambil data surat keluar
        $suratkeluar = $this->suratKeluarModel->find($id);

        // Ambil data penerbit dari tbl_karyawan + jabatan
        $penerbit = $this->karyawanModel->getPenerbit($suratkeluar->penerbit_id);

        $penerbit_nama = $penerbit->nama_lengkap ?? '';
        $penerbit_jabatan = $penerbit->nama_jabatan ?? '';

        // Data surat keluar
        $nomor    = $suratkeluar->no_surat;
        $tanggal  = $suratkeluar->tgl_surat;
        $perihal  = $suratkeluar->perihal;
        $lampiran = $suratkeluar->lampiran;
        $nama     = $suratkeluar->nama_klien;
        $tempat   = $suratkeluar->tempat;
        $konten   = $suratkeluar->konten;

        $qrImageBase64 = null;

        if (!empty($suratkeluar->qrcode)) {
            $url = base_url('verifikasi/surat/' . $suratkeluar->qrcode);
            $qrCode = new QrCode($url);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qrImageBase64 = $result->getDataUri();
        } else {
            // Gambar default jika qrcode kosong (konversi ke base64)
            $defaultImagePath = FCPATH . 'assets/images/qrcode.jpg'; // pastikan path-nya benar
            $qrImageBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($defaultImagePath));
        }



        // // Penentuan QR Code
        // $qrcodePath       = 'qrcodes/' . $suratkeluar->qrcode;
        // $qrcode_dirops_path = 'qrcodes/' . $suratkeluar->qrcode_dirops;
        // $qrcode_kadiv_path  = 'qrcodes/' . $suratkeluar->qrcode_kadiv;
        // $defaultSignature = 'assets/images/qrcode.jpg';

        // if (!empty($suratkeluar->qrcode) && file_exists($qrcodePath)) {
        //     $qrcode = $qrcodePath;
        // } elseif (!empty($suratkeluar->qrcode_dirops) && file_exists($qrcode_dirops_path)) {
        //     $qrcode = $qrcode_dirops_path;
        // } elseif (!empty($suratkeluar->qrcode_kadiv) && file_exists($qrcode_kadiv_path)) {
        //     $qrcode = $qrcode_kadiv_path;
        // } else {
        //     $qrcode = $defaultSignature;
        // }

        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'format' => [210, 330], // format F4
            'margin_top' => 35,
        ]);

        // Header
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

        // Footer
        $mpdf->SetHTMLFooter("
        <hr style='margin: 5px 0;'>
        <table style='font-size: 10px; margin-top: -10px;'>
            <tr>
                <td style='text-align: left; padding-right: 10px;'>
                    <b>Jalan Gerilya Tengah, Komplek Perum Griya Karang Indah Blok B4-5</b><br>
                    Purwokerto, Jawa Tengah 53142<br>
                    Telepon: (0281) 623 789 | Fax: (0281) 657 789<br>
                    Email: official@msodc.co.id | Website: <a href='http://www.msodc.co.id'>www.msodc.co.id</a>
                </td>
                <td style='text-align: right; padding-left: 10px;'>
                    <table border='1' style='border-collapse: collapse; width: 100%; text-align: center;'>
                        <tr>
                            <td colspan='3' style='height: 20px; font-weight: bold;'>Paraf</td>
                        </tr>
                        <tr>
                            <td style='height: 30px;'></td>
                            <td style='height: 30px;'></td>
                            <td style='height: 30px;'></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    ");

        // Konten utama (HTML untuk isi surat)
        $html = view('cetak/print_backdate', [
            'tgl_surat'        => $tanggal,
            'no_surat'         => $nomor,
            'lampiran'         => $lampiran,
            'perihal'          => $perihal,
            'nama_klien'       => $nama,
            'tempat'           => $tempat,
            'konten'           => $konten,
            'qrcode'           => $qrImageBase64,
            'penerbit_nama'    => $penerbit_nama,
            'penerbit_jabatan' => $penerbit_jabatan,
        ]);

        $mpdf->WriteHTML($html);

        // Encode hasil PDF sebagai base64 untuk dikembalikan via AJAX
        $pdfContent = base64_encode($mpdf->Output('', 'S'));

        return $this->response->setJSON([
            'pdf' => $pdfContent,
            'filename' => "Surat_Keluar_{$nomor}.pdf"
        ]);
    }

    public function export_pengumuman($id)
    {
        // Mendapatkan data dari database berdasarkan ID
        $suratkeluar = $this->suratKeluarModel->find($id);
        if (!$suratkeluar) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data surat keluar tidak ditemukan");
        }

        // Data yang diambil dari database
        $nomor    = $suratkeluar->no_surat;
        $lampiran = $suratkeluar->lampiran;
        $tanggal  = $suratkeluar->tgl_surat;
        $perihal  = $suratkeluar->perihal;
        $tempat   = $suratkeluar->tempat;
        $content  = $suratkeluar->konten;

        if (!empty($suratkeluar->qrcode)) {
            $url = base_url('verifikasi/surat/' . $suratkeluar->qrcode);
            $qrCode = new QrCode($url);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qrImageBase64 = $result->getDataUri();
        } else {
            // Gambar default jika qrcode kosong (konversi ke base64)
            $defaultImagePath = FCPATH . 'assets/images/qrcode.jpg'; // pastikan path-nya benar
            $qrImageBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($defaultImagePath));
        }
        // $qrcodePath = 'qrcodes/' . $suratkeluar->qrcode;
        // $defaultSignature = 'assets/images/ttd.png'; // Path tanda tangan default

        // if (empty($suratkeluar->qrcode) || !file_exists($qrcodePath)) {
        //     $qrcode = $defaultSignature; // Gunakan tanda tangan default jika QR code tidak ada
        // } else {
        //     $qrcode = $qrcodePath;
        // }
        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'format' => [210, 330], //format f4
            'margin_top' => 35,
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
        <hr style='margin: 5px 0;'> <!-- Sesuaikan jarak atas dan bawah garis -->
        <table style='font-size: 10px; margin-top: -10px;'> <!-- Kurangi jarak tabel dari garis -->
            <tr>
                <td style='text-align: left; padding-right: 10px;'>
                    <b>Jalan Gerilya Tengah, Komplek Perum Griya Karang Indah Blok B4-5</b><br>
                    Purwokerto, Jawa Tengah 53142<br>
                    Telepon: (0281) 623 789 | Fax: (0281) 657 789<br>
                    Email: official@msodc.co.id | Website: <a href='http://www.msodc.co.id'>www.msodc.co.id</a>
                </td>
                <td style='text-align: right; padding-left: 10px;'>
                    <table border='1' style='border-collapse: collapse; width: 100%; text-align: center;'>
                        <tr>
                            <td colspan='3' style='height: 20px; font-weight: bold;'>Paraf</td>
                        </tr>
                        <tr>
                            <td style='height: 30px;'></td>
                            <td style='height: 30px;'></td>
                            <td style='height: 30px;'></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    ");


        // Konten utama dokumen
        $html = view('cetak/print_pengumuman', [
            'tanggal'  => $tanggal,
            'nomor'    => $nomor,
            'lampiran' => $lampiran,
            'perihal'  => $perihal,
            'tempat'   => $tempat,
            'content'  => $content,
            'qrcode'   => $qrImageBase64,
        ]);

        $mpdf->WriteHTML($html);

        // Menyimpan PDF ke dalam string base64
        $pdfContent = base64_encode($mpdf->Output('', 'S'));

        // Mengembalikan respons JSON untuk AJAX
        return $this->response->setJSON(['pdf' => $pdfContent, 'filename' => "Surat_Keluar_{$nomor}.pdf"]);
        // // Menulis konten ke dalam PDF
        // $mpdf->WriteHTML($html);

        // // Menampilkan PDF sebagai unduhan
        // return $this->response->setHeader('Content-Type', 'application/pdf')
        //     ->setHeader('Content-Disposition', 'attachment; filename="Surat_Keluar_' . $nomor . '.pdf"')
        //     ->setBody($mpdf->Output('', 'S'));
    }

    public function export_surat_tugas($id)
    {
        // Mendapatkan data dari database berdasarkan ID
        $surattugas = $this->suratTugasModel->find($id);
        if (!$surattugas) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data surat keluar tidak ditemukan");
        }

        // Data yang diambil dari database
        $no_surat          = $surattugas->no_surat;
        $unit_kerja        = $surattugas->unit_kerja;
        $tempat_dituju     = $surattugas->tempat;
        $alamat            = $surattugas->alamat;
        $tugas             = $surattugas->tugas;
        $tanggal_berangkat = $surattugas->tgl_berangkat;
        $tanggal_kembali   = $surattugas->tgl_kembali;
        $lama_bertugas     = $surattugas->lama_bertugas;
        $jam_tugas         = $surattugas->jam_tugas;
        $tanggal_bertugas  = $surattugas->tgl_bertugas;
        $lpj               = $surattugas->lpj;
        $keterangan        = $surattugas->keterangan;
        $jam_berangkat     = $surattugas->jam_berangkat;
        $jam_kembali       = $surattugas->jam_kembali;
        $laporan           = $surattugas->laporan;
        // Ganti baris baru (\n) dengan tag HTML <br>
        $keterangan = nl2br($keterangan);

        // Data dari database
        $anggota = $surattugas->anggota;

        // Memecah anggota menjadi array berdasarkan koma
        $anggota_array = [];  // Inisialisasi sebagai array kosong
        if ($anggota) {
            $anggota_array = explode(',', $anggota); // Memisahkan anggota berdasarkan koma
        }

        $qrImageBase64 = null;

        if (!empty($surattugas->qrcode)) {
            $url = base_url('verifikasi/surat-tugas/' . $surattugas->qrcode);
            $qrCode = new QrCode($url);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qrImageBase64 = $result->getDataUri();
        } else {
            // Gambar default jika qrcode kosong (konversi ke base64)
            $defaultImagePath = FCPATH . 'assets/images/qrcode.jpg'; // pastikan path-nya benar
            $qrImageBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($defaultImagePath));
        }
        // $qrcode_path = 'qrcodes/surat_tugas/' . $surattugas->qrcode;
        // $default_signature = 'assets/images/qrcodeno.jpg'; // Path tanda tangan default

        // if (empty($surattugas->qrcode) || !file_exists($qrcode_path)) {
        //     $qrcode = $default_signature; // Gunakan tanda tangan default jika QR code tidak ada
        // } else {
        //     $qrcode = $qrcode_path;
        // }

        // // Memecah anggota menjadi array berdasarkan koma
        // $anggotaList = '';
        // if ($anggota) {
        //     $anggotaArray = explode(',', $anggota); // Memisahkan anggota berdasarkan koma
        //     foreach ($anggotaArray as $index => $anggota_item) {
        //         $anggotaList .= "<br>" . ($index + 1) . ") " . trim($anggota_item); // Menambahkan nomor urut
        //     }
        // }



        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            // 'format' => 'Legal',
            'format' => [210, 330], //format F4
            'margin_top' => 31,
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
        $html = view('cetak/print_surat_tugas', [
            'no_surat'      => $no_surat,
            'unit_kerja'    => $unit_kerja,
            'tempat'        => $tempat_dituju,
            'alamat'        => $alamat,
            'tugas'         => $tugas,
            'tgl_berangkat' => $tanggal_berangkat,
            'tgl_kembali'   => $tanggal_kembali,
            'lama_bertugas' => $lama_bertugas,
            'jam_tugas'     => $jam_tugas,
            'tgl_bertugas'  => $tanggal_bertugas,
            'lpj'           => $lpj,
            'keterangan'    => $keterangan,
            'anggota'       => $anggota_array,
            'qrcode'        => $qrImageBase64,
            'jam_berangkat' => $jam_berangkat,
            'jam_kembali'   => $jam_kembali,
            'laporan'       => $laporan
        ]);

        // Menulis konten ke dalam PDF
        $mpdf->WriteHTML($html);

        // Menyimpan PDF ke dalam string base64
        $pdfContent = base64_encode($mpdf->Output('', 'S'));

        // Mengembalikan respons JSON untuk AJAX
        return $this->response->setJSON(['pdf' => $pdfContent, 'filename' => "Surat_Tugas_{$no_surat}.pdf"]);
    }


    // Lapoaran Surat Masuk
    public function export_surat_masuk_pdf()
    {

        // Ambil data dari filter
        $tanggal_awal  = $this->request->getPost('tanggal_awal');
        $tanggal_akhir = $this->request->getPost('tanggal_akhir');
        $nama_klien    = $this->request->getPost('nama_klien');
        $progres       = $this->request->getPost('progres');

        if (empty($tanggal_awal) && empty($tanggal_akhir)) {
            $filteredData = $this->suratMasukModel->getAll($nama_klien, $progres);
            $periode = "Semua Data";
        } else {
            $filteredData = $this->suratMasukModel->getFiltered($tanggal_awal, $tanggal_akhir, $nama_klien, $progres);
            $periode = 'Periode ' . tanggal_indo($tanggal_awal) . ' s/d ' . tanggal_indo($tanggal_akhir);
        }

        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 30,
            'margin_bottom' => 20,
            'margin_left' => 15,
            'margin_right' => 15,
        ]);

        // HEADER
        $header = '
    <div class="pdf-header" style="text-align: center; margin-bottom: 20px;">
        <h3>Laporan Surat Masuk</h3>
        <p>' . $periode . '</p>
    </div>';
        $mpdf->SetHTMLHeader($header);

        // CSS dan TABLE HEADER
        $mpdf->WriteHTML('<style>
        .pdf-header {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 20px;
        }
        .table-bordered {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid black;
            padding: 7px;
            text-align: left;
        }
        .table-bordered th {
            background-color: #f2f2f2;
        }
        .table-bordered tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    </style>');

        $mpdf->WriteHTML('<table class="table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nomor Surat</th>
                <th>BPR/Klien</th>
                <th>Perihal</th>
                <th>Prioritas</th>
                <th>Progres</th>
            </tr>
        </thead>
        <tbody>');

        $no = 1;
        foreach ($filteredData as $data) {

            $mpdf->WriteHTML('
        <tr>
            <td>' . $no . '</td>
            <td>' . tanggal_indo($data->tgl_terima) . '</td>
            <td>' . $data->no_surat . '</td>
            <td>' . $data->nama_klien . '</td>
            <td>' . $data->perihal . '</td>
            <td>' . $data->prioritas_surat . '</td>
            <td>' . $data->progres_surat . '</td>
        </tr>');

            $no++;
        }
        $mpdf->WriteHTML('</tbody></table>');
        // $mpdf->Output('Laporan Surat Masuk.pdf', 'D');

        // ✅ Output sebagai string (bukan ke file, bukan ke browser langsung)
        $pdfContent = $mpdf->Output('', 'S');

        // ✅ Kirim response blob yang benar ke front-end AJAX
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Laporan Surat Masuk.pdf"')
            ->setBody($pdfContent);
    }
    public function export_surat_masuk_excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $tanggal_awal  = $this->request->getPost('tanggal_awal');
        $tanggal_akhir = $this->request->getPost('tanggal_akhir');
        $nama_klien    = $this->request->getPost('nama_klien');
        $progres       = $this->request->getPost('progres');

        // Ambil data sesuai filter atau semua data
        $periode_text = "Semua Data";
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $periode_text = "Periode : " . tanggal_indo($tanggal_awal) . " s/d " . tanggal_indo($tanggal_akhir);
        }

        // Set judul laporan di baris atas
        $sheet->setCellValue('A1', 'Laporan Surat Masuk');
        $sheet->setCellValue('A2', $periode_text);
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');

        // Header kolom
        $sheet->setCellValue('A4', 'No')
            ->setCellValue('B4', 'Tanggal Surat')
            ->setCellValue('C4', 'Tanggal Terima')
            ->setCellValue('D4', 'No Surat')
            ->setCellValue('E4', 'BPR/Klien')
            ->setCellValue('F4', 'Perihal')
            ->setCellValue('G4', 'Status Surat')
            ->setCellValue('H4', 'Progres Surat')
            ->setCellValue('I4', 'Handler');


        // Ambil data berdasarkan kondisi filter
        // Ambil data
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $query = $this->suratMasukModel->getFiltered($tanggal_awal, $tanggal_akhir, $nama_klien, $progres);
        } else {
            $query = $this->suratMasukModel->getAll($nama_klien, $progres);
        }

        // Isi data
        $row = 5;
        $no = 1;
        foreach ($query as $data) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data->tgl_surat);
            $sheet->setCellValue('C' . $row, $data->tgl_terima);
            $sheet->setCellValue('D' . $row, $data->no_surat);
            $sheet->setCellValue('E' . $row, $data->nama_klien);
            $sheet->setCellValue('F' . $row, $data->perihal);
            $sheet->setCellValue('G' . $row, $data->status_surat);
            $sheet->setCellValue('H' . $row, $data->progres_surat);
            $sheet->setCellValue('I' . $row, $data->handler_surat);

            $no++;
            $row++;
        }

        // Atur header untuk download file
        // Set orientasi halaman dan judul sheet
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("Laporan Surat Masuk");

        ob_end_clean(); //digunakan ketika file tidak bisa dibuka diexcel
        // Set header untuk mendownload file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Surat Masuk.xlsx"');
        header('Cache-Control: max-age=0');

        // Simpan file Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}

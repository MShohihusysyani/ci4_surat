<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use CodeIgniter\HTTP\ResponseInterface;


class Export extends BaseController
{
    protected $suratKeluarModel, $karyawanModel;
    public function __construct()
    {
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->karyawanModel       = new KaryawanModel();
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

        // URL yang akan di-encode ke dalam QR Code
        $url = base_url('pindai/surat/' . $suratkeluar->qrcode);

        // Buat QR Code instance dan chaining konfigurasi dengan benar
        $qrCode = (new QrCode($url));

        // Tulis QR Code ke image
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Convert ke data URI agar bisa ditampilkan langsung tanpa disimpan
        $qrImageBase64 = $result->getDataUri();


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

        $qrcodePath = 'qrcodes/' . $suratkeluar->qrcode;
        $defaultSignature = 'assets/images/ttd.png'; // Path tanda tangan default

        if (empty($suratkeluar->qrcode) || !file_exists($qrcodePath)) {
            $qrcode = $defaultSignature; // Gunakan tanda tangan default jika QR code tidak ada
        } else {
            $qrcode = $qrcodePath;
        }
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
            'qrcode'   => $qrcode,
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
}

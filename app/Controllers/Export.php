<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use App\Models\KaryawanModel;
use App\Models\SuratTugasModel;
use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use Endroid\QrCode\Writer\PngWriter;
use CodeIgniter\HTTP\ResponseInterface;


class Export extends BaseController
{
    protected $suratKeluarModel, $suratTugasModel, $karyawanModel;
    public function __construct()
    {
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
            $url = base_url('pindai/surat/' . $suratkeluar->qrcode);
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
            $url = base_url('pindai/surat/' . $suratkeluar->qrcode);
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

        $qrcode_path = 'qrcodes/surat_tugas/' . $surattugas->qrcode;
        $default_signature = 'assets/images/qrcodeno.jpg'; // Path tanda tangan default

        if (empty($surattugas->qrcode) || !file_exists($qrcode_path)) {
            $qrcode = $default_signature; // Gunakan tanda tangan default jika QR code tidak ada
        } else {
            $qrcode = $qrcode_path;
        }

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
            'format' => 'Legal',
            // 'format' => [210, 330], //format F4
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
            'qrcode'        => $qrcode,
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
}

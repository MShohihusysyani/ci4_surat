<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Perjalanan Kerja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
        }

        .header img {
            width: 100px;
        }

        .subheader {
            text-align: center;
            font-size: 12pt;
            margin-top: -10px;
        }

        .content {
            margin-top: -20px;
            font-size: 11pt;
            /* margin-bottom: 20px; */
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content table td {
            vertical-align: top;
            padding: 5px;
        }

        .checkbox {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid black;
            text-align: center;
            line-height: 20px;
            margin-right: 5px;
        }

        .footer {
            font-size: 11pt;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* Membagi elemen kiri dan kanan */
            align-items: flex-start;
            /* Menjaga elemen tetap rata atas */
            margin-top: 40px;
            /* Jarak dari konten sebelumnya */
            page-break-inside: avoid;
            /* Mencegah footer pecah ke halaman berikutnya */
        }

        .footer .left-signature {
            text-align: center;
            width: 45%;
            /* Lebar elemen kiri */
            margin-top: 20px;
            /* Menggeser elemen lebih ke bawah */
        }

        .footer .right-signature {
            text-align: right;
            width: 100%;
            /* Lebar elemen kanan */
            margin-top: -140px;
            margin-left: auto;
            /* Menggeser elemen lebih ke atas */
        }

        .right-signature img {
            height: 80px;
            margin: 5px 0;
            /* Jarak vertikal antara teks dan gambar */
        }

        .footer p {
            margin: 0 0;
            /* Mengatur jarak antar paragraf */
        }
    </style>
</head>

<body>
    <div class="subheader">
        <p> <b>SURAT PERINTAH PERJALANAN KERJA </b></p>
        <p>Nomor: <?= $nomor ?></p>
    </div>

    <div class="content">
        <p>Diperintahkan kepada:</p>
        <table>
            <tr>
                <td valign="top" style="width: 40%; text-align:left">1. Nama</td>
                <td style="width: 60%;">:
                    <?php
                    $no = 1;
                    foreach ($anggota as $anggota_item) {
                        if ($no == 1) {
                            echo $no . ') ' . trim($anggota_item) . '<br>';
                        } else {
                            echo '&nbsp;&nbsp;' . $no . ') ' . trim($anggota_item) . '<br>';
                        }
                        $no++;
                    }
                    ?>
                </td>
            </tr>

            <!-- <tr>
                <td>1. Nama</td>
                <td>:
                    <?php
                    $no = 1;
                    // Menampilkan anggota dengan format 1) Nama Anggota
                    foreach ($anggota as $anggota_item) {
                        echo $no . ') ' . trim($anggota_item) . '<br>';
                        $no++;
                    }
                    ?>
                </td>
            </tr> -->
            <tr>
                <td>2. Unit Kerja</td>
                <td>: <?= $unitKerja ?></td>
            </tr>
            <tr>
                <td>3. Tujuan Perjalanan Dinas</td>
                <!-- <td>
                    <p>a. Nama tempat yang dituju : <?= $tempatDituju ?> </p>
                    <p>b. Alamat yang dituju : <?= $alamat ?></p>
                    <p>c. Maksud : <?= $tugas ?></p>
                    <p>d. Perjalanan dinas menggunakan :</p>
                    <p>
                        &#9744; AVANZA
                        &#9744; XENIA
                        &#9744; KeretaApi
                        &#9744; Pesawat
                        &#9744; Bus/Travel
                    </p>
                </td> -->
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; a. Nama tempat yang dituju</td>
                <td> : <?= $tempatDituju ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; b. Alamat yang dituju</td>
                <td> : <?= $alamat ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; c. Maksud</td>
                <td> : <?= $tugas ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; d. Perjalanan dinas menggunakan</td>
                <td> : &#9744; AVANZA
                    &#9744; XENIA
                    &#9744; KeretaApi
                    &#9744; Pesawat
                    &#9744; Bus/Travel</td>
            </tr>

            <tr>
                <td>4. Waktu & Tanggal Bertugas</td>
                <!-- <td>
                    <p>a. Tanggal & Jam Berangkat : <?= tanggal_indo($tanggalBerangkat) ?> Jam <?= $jam_berangkat ?> WIB</p>
                    <p>b. Lama tugas : <?= $lamaTugas ?> hari kerja</p>
                    <p>c. Tanggal Bertugas : <?= tanggal_indo($tanggalBertugas) ?></p>
                    <p>d. Jam Tugas : <?= $jamTugas ?></p>
                    <p>e. Tanggal & Jam kembali : <?= tanggal_indo($tanggalKembali) ?> Jam <?= $jam_kembali ?> WIB</p>
                </td> -->
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; a. Tanggal & Jam Berangkat</td>
                <td> : <?= tanggal_indo($tanggalBerangkat) ?> Jam <?= $jam_berangkat ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; b. Lama Tugas</td>
                <td> : <?= $lamaTugas ?> hari kerja</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; c. Tanggal Bertugas</td>
                <td> : <?= tanggal_indo($tanggalBertugas) ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; d. Jam Tugas</td>
                <td> : <?= $jamTugas ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp; a. Tanggal & Jam Kembali</td>
                <td> : <?= tanggal_indo($tanggalKembali) ?> Jam <?= $jam_kembali ?></td>
            </tr>

            <tr>
                <td>5. Laporan Pertanggung Jawaban</td>
                <td>: <?= $lpj ?></td>
            </tr>
            <tr>
                <td>6. Keterangan</td>
                <!-- <td>: </td> -->
                <!-- <td>: <?= $keterangan ?></td> -->
            </tr>
        </table>
        <p><?= $keterangan ?></p>
    </div>
    <!-- Tambahan tabel untuk yang diberi tugas -->
    <table border="1" style="width: 55%; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <td colspan="3" style="text-align: left; padding: 8px;">Yang diberi Tugas:</td>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($anggota as $anggotaItem): ?>
            <tr>
                <td style="width: 5%; text-align: center; padding: 10px; border-right: 1px solid #000;"><?= $no++ ?></td> <!-- Add vertical border -->
                <td style="padding: 8px;"><?= trim($anggotaItem) ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>

        <!-- Tambahkan baris kosong jika diperlukan -->
        <?php for ($i = count($anggota); $i < 4; $i++): ?>
            <tr>
                <td style="width: 5%; text-align: center; padding: 8px; border-right: 1px solid #000;"><?= $no++ ?></td>
                <td style="padding: 8px;">&nbsp;</td>
                <td></td>
            </tr>
        <?php endfor; ?>

        <tr>
            <td colspan="3" style="text-align: left; padding: 8px;">Laporan:</td>
        </tr>
        <tr>
            <td style="width: 5%; text-align: center; padding: 8px; border-right: 1px solid #000;">1</td> <!-- Add vertical border -->
            <td style="padding: 8px;"><?= $laporan ?></td>
            <td></td>
        </tr>
    </table>

    <div class="footer" style="page-break-inside: avoid; display: flex; flex-wrap: wrap; margin-top: 20px;">
        <!-- Tanda tangan kiri -->
        <div class="left-signature" style="width:50%; text-align: center; margin-top: 10px;">
            <p>Mengetahui</p>
            <p>Pejabat yang dituju</p><br><br>
            <p>(..........................................)</p>
        </div>

        <!-- Tanda tangan kanan -->
        <div class="right-signature" style="margin-top: -395px; margin-left: auto; text-align: right; width: 50%;">
            <p>Purwokerto, <?= tanggal_indo($tanggalBertugas) ?></p>
            <p>PT. Mitranet Software Online</p>
            <?php if (!empty($qrcode)) : ?>
                <!-- Tampilkan QR code jika dokumen sudah di-approve -->
                <p><img src="<?= $qrcode ?>" style="height: 100px;" alt="QR Code" loading="lazy">
                </p>
            <?php else : ?>
                <!-- Tampilkan tanda tangan gambar jika belum di-approve -->
            <?php endif; ?>
            <!-- <img src="assets/images/ttd.png" height="80px" alt="Tanda Tangan"> -->
            <p>(Sobirin, SE)</p>
            <p>Direktur Utama</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .content {
            margin-top: 20px;
            text-align: left;
        }

        .footer {
            text-align: center;
            font-size: small;
            margin-top: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            font-size: 11pt;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .right-align {
            text-align: left;
            /* Tetap rata kiri dalam elemen */
        }

        .header-table td {
            vertical-align: top;
        }

        /* Pengaturan agar teks "Hormat Kami" sampai dengan "Direktur Utama" berada di kanan */
        .right-side {
            text-align: right;
            page-break-inside: avoid;
            display: inline-block;
            margin-top: 20px;
            margin-bottom: 100px;
            /* Tambahkan jarak ke bawah */
            width: 100%;
        }

        .right-side p {
            margin: 0 0;
        }
    </style>
</head>

<body>
    <div style="font-family: Arial, sans-serif;">
        <table class="header-table" width="100%">
            <tr>
                <td width="63%"></td>
                <td width="37%" style="text-align: left;">Purwokerto, <?= tanggal_indo($tgl_surat) ?></td>
            </tr>
        </table>
        <br>
        <table style="font-size: 11pt; width: 60%; border-collapse: collapse;">
            <tr>
                <td style="width: 20%; text-align: left;">Nomor</td>
                <td style="width: 5%;">:</td>
                <td style="width: 75%;"><?= $no_surat ?></td>
            </tr>
            <tr>
                <td style="text-align: left;">Lampiran</td>
                <td>:</td>
                <td><?= $lampiran ?></td>
            </tr>
            <tr>
                <td style="text-align: left;">Perihal</td>
                <td>:</td>
                <td><b><?= $perihal ?></b></td>
            </tr>
        </table>
        <br>

        <!-- Membuat dua kolom, kiri untuk teks "Kepada Yth." dan kanan untuk "Purwokerto" -->
        <table width="100%">
            <tr>
                <td width="63%"></td>
                <td style="width: 37%; text-align: left;">
                    <p>Kepada Yth.<br>Direktur<br><?= $nama_klien ?><br>Di<br><?= $tempat ?></p>
                </td>
            </tr>
        </table>

        <p><?= $konten ?></p>

        <!-- Bagian "Hormat Kami" dan seterusnya di sebelah kanan -->
        <div class="right-side">
            <p>Hormat Kami,
            <p>PT. MITRANET SOFTWARE ONLINE</p>
            <p>Purwokerto</p>

            <?php if (!empty($qrcode)) : ?>
                <!-- Tampilkan QR code jika dokumen sudah di-approve -->
                <p><img src="<?= $qrcode ?>" style="height: 100px;" alt="QR Code" loading="lazy">
                </p>
            <?php else : ?>
                <!-- Tampilkan tanda tangan gambar jika belum di-approve -->
            <?php endif; ?>

            <p><?= $penerbit_nama ?></p>
            <p><?= $penerbit_jabatan ?></p>
        </div>

    </div>
</body>

</html>
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
            padding-top: 50px;
            /* Jarak atas agar sesuai dengan penataan */
        }
    </style>
</head>

<body>
    <div style="font-family: Arial, sans-serif;">
        <table class="header-table" width="100%">
            <tr>
                <td width="63%"></td>
                <td width="37%" style="text-align: left;">Purwokerto, <?= tanggal_indo($suratkeluar['tgl_surat']) ?></td>
            </tr>
        </table>
        <br>
        <table style="font-size: 11pt; width: 100%; border-collapse: collapse;">
            <tr>
                <!-- Kolom kiri (Nomor, Lampiran, Perihal) -->
                <td style="width: 60%; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 20%; text-align: left;">Nomor</td>
                            <td style="width: 5%;">:</td>
                            <td style="width: 75%;"><?= $suratkeluar['no_surat'] ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Lampiran</td>
                            <td>:</td>
                            <td><?= $suratkeluar['lampiran'] ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Perihal</td>
                            <td>:</td>
                            <td><b><?= $suratkeluar['perihal'] ?></b></td>
                        </tr>
                    </table>
                </td>

                <!-- Kolom kanan (Kepada Yth.) -->
                <td style="width: 40%; vertical-align: top;">
                    <p>
                        Kepada Yth.<br>
                        Direktur<br>
                        1. PT. BPR BKK (PERSERODA)<br>
                        2. PT BPR<br>
                        3. PT BPR BANK (PERSERODA)<br>
                        4. PERUMDA BPR<br>
                        5. KOSPIN<br><br>
                        Di<br>
                        Tempat
                    </p>
                </td>
            </tr>
        </table>



        <p><?= $konten ?></p>
        <br>
        <!-- Bagian "Hormat Kami" dan seterusnya di sebelah kanan -->
        <div class="right-side">
            <p>Hormat Kami,<br>PT. MITRANET SOFTWARE ONLINE<br>Purwokerto</p>
            <p><img src='assets/images/ttd.png' style='height: 60px;' alt='Tanda Tangan'></p>
            <p><?= $penerbit_nama ?><br><?= $penerbit_jabatan ?></p>
        </div>
    </div>
</body>

</html>
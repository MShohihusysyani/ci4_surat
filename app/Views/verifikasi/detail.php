<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Verifikasi Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/mso.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: url('https://www.transparenttextures.com/patterns/cubes.png') repeat;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-radius: 16px 16px 0 0;
            font-weight: 600;
            font-size: 1rem;
            padding: 1rem 1.25rem;
        }

        .section-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 0.25rem;
        }

        .table th {
            width: 35%;
            color: #6c757d;
            font-weight: 500;
        }

        .text-muted {
            font-size: 0.95rem;
        }

        .quote-box {
            background: #ffffff;
            border-left: 5px solid #198754;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            position: relative;
        }

        .quote-box::before {
            content: "“";
            font-size: 3rem;
            color: #198754;
            position: absolute;
            top: -15px;
            left: 10px;
        }
    </style>
</head>

<body>
    <div class="container py-5">

        <div class="mb-4 text-center">
            <h2 class="fw-bold">Detail Verifikasi Surat</h2>
            <p class="text-muted">Pastikan keaslian surat berdasarkan data yang tercatat</p>
        </div>

        <!-- Informasi Surat -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-envelope-fill me-2"></i>Informasi Surat
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th><i class="bi bi-hash me-1"></i>No Surat</th>
                        <td><?= esc($surat->no_surat) ?></td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-chat-left-text-fill me-1"></i>Perihal</th>
                        <td><?= esc($surat->perihal) ?></td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar3 me-1"></i>Tanggal</th>
                        <td><?= esc($surat->tgl_surat) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Verifikasi Penandatangan -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-shield-check me-2"></i>Verifikasi Penandatangan
            </div>
            <div class="card-body">
                <?php foreach ($approval as $a): ?>
                    <div class="quote-box text-dark">
                        <p class="mb-2">
                            <strong><?= esc($surat->nama_lengkap ?? '-') ?></strong> adalah pengguna yang telah menandatangani dokumen
                            <strong>"<?= esc($surat->perihal) ?>"</strong> pada <strong><?= esc(tanggal_indo($a['approved_at'])) ?></strong>.
                        </p>
                        <p class="mb-0">
                            Verifikasi ini diterbitkan oleh <strong>PT MSO PURWOKERTO</strong> sebagai bagian dari sistem persetujuan resmi.
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
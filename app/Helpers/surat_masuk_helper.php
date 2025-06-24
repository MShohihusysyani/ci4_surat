<?php
if (!function_exists('formatFilePreview')) {
    function formatFilePreview($file, $id)
    {
        if (empty($file)) {
            return '<span>Tidak ada file</span>';
        }

        $file_url = base_url('file/surat_masuk/' . $file);

        if (preg_match('/\.pdf$/i', $file)) {
            return '<a href="#" class="preview-file pdf" data-toggle="modal" data-target="#previewModal" data-file-url="' . $file_url . '" data-id="' . $id . '">
    <i class="icofont icofont-file-pdf"></i>
</a>';
        } elseif (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            return '<a href="#" class="image-preview" data-toggle="modal" data-target="#imageModal" data-file-url="' . $file_url . '" data-id="' . $id . '">
    <i class="icofont icofont-file-jpg"></i>
</a>';
        } elseif (preg_match('/\.docx?$/i', $file)) {
            return '<a href="' . $file_url . '" target="_blank">Open Word Document</a>';
        }

        return '<span>File tidak dikenali</span>';
    }
}

if (!function_exists('formatStatusSurat')) {
    function formatStatusSurat($status)
    {
        return match ($status) {
            'Belum dibaca' => '<span class="badge badge-primary">Belum dibaca</span>',
            'Sudah dibaca' => '<span class="badge badge-success">Sudah dibaca</span>',
            default => '<span class="badge badge-secondary">-</span>',
        };
    }
}

// Surat Masuk
if (!function_exists('formatProgresSurat')) {
    function formatProgresSurat($progres)
    {
        return match ($progres) {
            'Proses' => '<span class="badge badge-primary">Proses</span>',
            'Proses Disposisi' => '<span class="badge badge-info">Proses Disposisi</span>',
            'Handle' => '<span class="badge badge-info">Handle</span>',
            'Finish' => '<span class="badge badge-success">Finish</span>',
            'Arsip' => '<span class="badge badge-warning">Arsip</span>',
            'Proses Disposal' => '<span class="badge badge-info">Proses Disposal</span>',
            'Disposal' => '<span class="badge badge-success">Disposal</span>',
            default => '<span class="badge badge-secondary">-</span>',
        };
    }
}

// Surat Keluar
if (!function_exists('formatProgresSuratKeluar')) {
    function formatProgresSuratKeluar($progres)
    {
        return match ($progres) {
            'proses draft' => '<span class="badge badge-primary">Proses Draft</span>',
            'draft' => '<span class="badge badge-info">Draft</span>',
            'proses approve' => '<span class="badge badge-info">proses pprove</span>',
            'Approve' => '<span class="badge badge-success">Approve</span>',
            default => '<span class="badge badge-danger">-</span>',
        };
    }
}

if (!function_exists('formatStatusBalas')) {
    function formatStatusBalas($butuh_balas, $status_balas)
    {
        if ($butuh_balas == 'Ya') {
            return $status_balas == 'sudah dibalas'
                ? '<span class="badge badge-success">Sudah Dibalas</span>'
                : '<span class="badge badge-warning">Belum Dibalas</span>';
        }

        return '<span class="badge badge-secondary">Tidak Perlu Dibalas</span>';
    }
}

if (!function_exists('formatAksiSuratMasuk')) {
    function formatAksiSuratMasuk($row)
    {
        $dropdown = '<div class="btn-group">';
        $dropdown .= '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> Aksi
                    </button>';
        $dropdown .= '<ul class="dropdown-menu">';

        // Disposisi (jika progres surat Proses)
        if ($row->progres_surat == 'Proses') {
            $dropdown .= '
                <li>
                    <a class="dropdown-item"
                        href="#" data-bs-toggle="modal" data-bs-target="#modal-disposisi"
                        data-id_surat_masuk="' . $row->id_surat_masuk . '"
                        data-no_surat="' . htmlspecialchars($row->no_surat) . '"
                        data-tgl_surat="' . htmlspecialchars($row->tgl_surat) . '"
                        data-perihal="' . htmlspecialchars($row->perihal) . '"
                        data-file="' . htmlspecialchars($row->file) . '"
                        data-produk="' . htmlspecialchars($row->produk) . '"
                        data-progres_surat="' . htmlspecialchars($row->progres_surat) . '">
                        <i class="icon-back-right"></i> Disposisi
                    </a>
                </li>';
        }

        // Detail
        $dropdown .= '
            <li>
                <a class="dropdown-item" href="/surat-masuk/detail/' . $row->id_surat_masuk . '">
                    <i class="icon-eye"></i> Detail
                </a>
            </li>';

        // Riwayat
        $dropdown .= '
            <li>
                <a class="dropdown-item" href="/riwayat/riwayat_surat_masuk/' . $row->id_surat_masuk . '">
                    <i class="icon-clock"></i> Riwayat
                </a>
            </li>';

        // Arsip (jika progres surat Finish)
        if ($row->progres_surat == 'Finish') {
            $dropdown .= '
                <li>
                    <a class="dropdown-item"
                        href="#" data-bs-toggle="modal" data-bs-target="#modal-arsip"
                        data-id="' . $row->id_surat_masuk . '"
                        data-no_surat="' . htmlspecialchars($row->no_surat) . '"
                        data-input_by="' . htmlspecialchars($row->input_by) . '"
                        data-tgl_surat="' . $row->tgl_surat . '"
                        data-tgl_terima="' . $row->tgl_terima . '"
                        data-perihal="' . htmlspecialchars($row->perihal) . '"
                        data-file="' . htmlspecialchars($row->file) . '"
                        data-produk="' . htmlspecialchars($row->produk) . '"
                        data-progres_surat="' . htmlspecialchars($row->progres_surat) . '"
                        data-status_surat="' . htmlspecialchars($row->status_surat) . '">
                        <i class="icon-folder"></i> Arsip
                    </a>
                </li>';
        }

        // Balas (jika surat Finish/Handle dan butuh balas serta belum dibalas)
        if (
            ($row->progres_surat == 'Finish' || $row->progres_surat == 'Handle') &&
            $row->butuh_balas == 'Ya' &&
            $row->status_balas == 'belum dibalas'
        ) {
            $dropdown .= '
                <li>
                    <a class="dropdown-item" href="/surat-masuk/balas/' . $row->id_surat_masuk . '">
                        <i class="icon-pencil"></i> Balas
                    </a>
                </li>';
        }

        $dropdown .= '</ul></div>';
        return $dropdown;
    }
}

if (!function_exists('formatAksiSuratKeluar')) {
    function formatAksiSuratKeluar($row)
    {
        $dropdown = '<div class="btn-group">';
        $dropdown .= '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> Aksi
                    </button>';
        $dropdown .= '<ul class="dropdown-menu">';

        // Riwayat
        $dropdown .= '
            <li>
                <a class="dropdown-item" href="/riwayat/riwayat_surat_keluar/' . $row->id_surat_keluar . '">
                    <i class="icon-clock"></i> Riwayat
                </a>
            </li>';

        // Preview
        // Preview
        if ($row->jenis_surat != 'manual') {
            $template = isset($row->template) ? $row->template : ''; // 👈 Fix di sini
            $dropdown .= '
                <li>
                    <a class="dropdown-item preview"
                        data-id_surat_keluar="' . $row->id_surat_keluar . '"
                        data-template="' . $template . '"
                        data-tipe="suratkeluar">
                        <i class="icon-eye"></i> Preview
                    </a>
                </li>';
        }

        $dropdown .= '</ul></div>';
        return $dropdown;
    }
}

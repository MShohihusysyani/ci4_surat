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
        $btn_group = '<ul class="action">';

        if ($row->progres_surat == 'Proses') {
            $btn_group .= '
                <li class="edit">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-disposisi"
                        data-id_surat_masuk="' . $row->id_surat_masuk . '"
                        data-no_surat="' . htmlspecialchars($row->no_surat) . '"
                        data-tgl_surat="' . htmlspecialchars($row->tgl_surat) . '"
                        data-perihal="' . htmlspecialchars($row->perihal) . '"
                        data-file="' . htmlspecialchars($row->file) . '"
                        data-produk="' . htmlspecialchars($row->produk) . '"
                        data-progres_surat="' . htmlspecialchars($row->progres_surat) . '">
                        <i class="icon-back-right" title="Disposisi"></i>
                    </a>
                </li>';
        }

        $btn_group .= '
            <li class="detail">
                <a href="/surat-masuk/detail/' . $row->id_surat_masuk . '">
                    <i class="icon-eye" title="Detail"></i>
                </a>
            </li>';

        $btn_group .= '
            <li class="history">
                <a href="/riwayat/riwayat_surat_masuk/' . $row->id_surat_masuk . '">
                    <i class="icon-clock" title="Riwayat"></i>
                </a>
            </li>';

        if ($row->progres_surat == 'Finish') {
            $btn_group .= '
                <li class="arsip">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-arsip"
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
                        <i class="icon-folder" title="Arsip"></i>
                    </a>
                </li>';
        }

        if (($row->progres_surat == 'Finish' || $row->progres_surat == 'Handle') && $row->butuh_balas == 'Ya' && $row->status_balas == 'belum dibalas') {
            $btn_group .= '
                <li class="balas">
                    <a href="/surat-masuk/balas-surat/' . $row->id_surat_masuk . '">
                        <i class="icon-pencil" title="Balas"></i>
                    </a>
                </li>';
        }

        $btn_group .= '</ul>';
        return $btn_group;
    }
}

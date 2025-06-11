<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_masuk_id',
        'nomor_surat_masuk',
        'template',
        'jenis_surat',
        'klien_id',
        'nama_klien',
        'tempat',
        'no_surat',
        'tgl_surat',
        'lampiran',
        'file_lampiran',
        'perihal',
        'konten',
        'penerbit_id',
        'progres',
        'status',
        'prioritas',
        'file_scan',
        'qrcode',
        'qrcode_dirops',
        'qrcode_kadiv',
        'tagas',
        'handle_by',
        'catatan_kadiv',
        'catatan_dirops',
        'catatan_dirut',
        'tgl_kirim',
        'waktu_kirim',
        'metod_kirim',
        'tgl_approve_kadiv',
        'tgl_approve_dirops',
        'tgl_approve_dirut',
        'tgl_arsip',
        'created_at',
        'updated_at',
        'user_id_input'

    ];

    public function getData()
    {

        $data = $this->db->table('surat_keluar');
        $data->select('surat_keluar.*');
        $data->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $query = $data->get();

        return $query->getResult();
    }
}

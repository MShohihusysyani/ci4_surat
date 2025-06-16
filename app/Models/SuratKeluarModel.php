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

    public function getDataDraft()
    {
        $data = $this->db->table('surat_keluar');
        $data->select('surat_keluar.*');
        $data->where('progres', 'Draft');
        $data->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $query = $data->get();

        return $query->getResult();
    }

    public function getDisposisi()
    {
        $id_user = session()->get('id_user');

        $disposisi = $this->db->table('surat_keluar');
        $disposisi->select('surat_keluar.*');
        $disposisi->where('progres', 'Proses Approve');
        $disposisi->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $disposisi->join('disposisi_surat_keluar', 'surat_keluar.id_surat_keluar = disposisi_surat_keluar.surat_keluar_id', 'left');
        $disposisi->where('disposisi_surat_keluar.user_id', $id_user);
        $query = $disposisi->get();

        return $query->getResult();
    }

    public function getSurat($id)
    {

        $edit = $this->db->table('surat_keluar');
        $edit->select('surat_keluar.*');
        $edit->where('id_surat_keluar', $id);
        $query = $edit->get();

        return $query->getResult();
    }

    public function disposisi($id_surat)
    {
        $query = "UPDATE surat_keluar SET progres='Proses Approve'   where id_surat_keluar=$id_surat";
        return $this->db->query($query);
    }
}

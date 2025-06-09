<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiKadivModel extends Model
{
    protected $table            = 'disposisi_kadiv';
    protected $primaryKey       = 'id_disposisi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'opject';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_masuk_id',
        'user_id',
    ];

    public function getData()
    {
        $id_user = session()->get('id_user');
        $builder = $this->db->table('surat_masuk');
        $builder->select('surat_masuk.id_surat_masuk, surat_masuk.surat_dari, surat_masuk.no_surat, surat_masuk.tgl_surat, surat_masuk.tgl_terima, surat_masuk.perihal, surat_masuk.produk, surat_masuk.perusahaan, surat_masuk.tujuan_surat, surat_masuk.handler_surat, surat_masuk.status_surat, surat_masuk.progres_surat, surat_masuk.tags, surat_masuk.input_by, surat_masuk.file, surat_masuk.butuh_balas, surat_masuk.status_balas, surat_masuk.catatan_kadiv, surat_masuk.catatan_dirops, surat_masuk.status_disposisi_kadiv, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');
        $builder->join('disposisi_kadiv', 'surat_masuk.id_surat_masuk = disposisi_kadiv.surat_masuk_id', 'left');
        $builder->where('surat_masuk.progres_surat ', 'Proses Disposisi');
        $builder->where('disposisi_kadiv.user_id', $id_user);
        $builder->where('surat_masuk.catatan_kadiv', '');
        $builder->orderBy('tgl_terima', 'DESC');
        $query = $builder->get();

        // Kembalikan hasil query
        return $query->getResult();
    }
}

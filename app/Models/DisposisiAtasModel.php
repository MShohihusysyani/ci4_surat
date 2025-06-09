<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiAtasModel extends Model
{
    protected $table            = 'disposisi_atas';
    protected $primaryKey       = 'id_disposisi_atas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_masuk_id',
        'user_id',
    ];

    public function simpanAtauUpdate($suratId, $userId, $data)
    {
        $existing = $this->where('surat_masuk_id', $suratId)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            $this->where('surat_masuk_id', $suratId)
                ->where('user_id', $userId)
                ->set($data)
                ->update();
            return 'Updated';
        } else {
            $this->insert($data);
            return 'Created';
        }
    }

    public function getDataDirops()
    {
        $id_user = session()->get('id_user');
        // Buat query untuk mengambil surat masuk yang telah didisposisi oleh Kadiv
        $builder = $this->db->table('surat_masuk');
        $builder->select('surat_masuk.id_surat_masuk, surat_masuk.surat_dari, surat_masuk.no_surat, surat_masuk.tgl_surat, surat_masuk.tgl_terima, surat_masuk.perihal, surat_masuk.produk, surat_masuk.perusahaan, surat_masuk.tujuan_surat, surat_masuk.handler_surat, surat_masuk.status_surat, surat_masuk.progres_surat, surat_masuk.tags, surat_masuk.input_by, surat_masuk.file, surat_masuk.butuh_balas, surat_masuk.status_balas, surat_masuk.catatan_kadiv, surat_masuk.catatan_dirops, surat_masuk.disposisi_kadiv, surat_masuk.disposisi_dirops, surat_masuk.disposisi_dirut, surat_masuk.status_disposisi_dirops, surat_masuk.status_disposisi_dirut, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');
        $builder->join('disposisi_atas', 'surat_masuk.id_surat_masuk = disposisi_atas.surat_masuk_id', 'left');
        $builder->where('disposisi_atas.user_id', $id_user);
        $builder->where('surat_masuk.catatan_dirops', '');
        $builder->where('surat_masuk.progres_surat', 'Proses Disposisi');
        $builder->orderBy('tgl_terima', 'DESC');
        $query = $builder->get();

        // Kembalikan hasil query
        return $query->getResult();
    }

    public function getDataDirut()
    {
        $id_user = session()->get('id_user');
        // Buat query untuk mengambil surat masuk yang telah didisposisi oleh Kadiv
        $builder = $this->db->table('surat_masuk');
        $builder->select('surat_masuk.id_surat_masuk, surat_masuk.surat_dari, surat_masuk.no_surat, surat_masuk.tgl_surat, surat_masuk.tgl_terima, surat_masuk.perihal, surat_masuk.produk, surat_masuk.perusahaan, surat_masuk.tujuan_surat, surat_masuk.handler_surat, surat_masuk.status_surat, surat_masuk.progres_surat, surat_masuk.tags, surat_masuk.input_by, surat_masuk.file, surat_masuk.butuh_balas, surat_masuk.status_balas, surat_masuk.catatan_kadiv, surat_masuk.catatan_dirops, surat_masuk.disposisi_kadiv, surat_masuk.disposisi_dirops, surat_masuk.disposisi_dirut, surat_masuk.status_disposisi_dirops, surat_masuk.status_disposisi_dirut, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');
        $builder->join('disposisi_atas', 'surat_masuk.id_surat_masuk = disposisi_atas.surat_masuk_id', 'left');
        $builder->where('disposisi_atas.user_id', $id_user);
        $builder->whereIn('surat_masuk.progres_surat', ['Proses Disposisi', 'Handle']);
        $builder->orderBy('tgl_terima', 'DESC');
        $query = $builder->get();

        // Kembalikan hasil query
        return $query->getResult();
    }
}

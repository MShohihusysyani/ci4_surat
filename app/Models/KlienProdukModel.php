<?php

namespace App\Models;

use CodeIgniter\Model;

class KlienProdukModel extends Model
{
    protected $table            = 'klien_produk';
    protected $primaryKey       = 'id_klien_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'no_klien',
        'nama_klien',
        'nama_produk',
        'deskripsi',
        'tgl_pakai',
        'tgl_jatuh_tempo',
        'jangka_waktu',
        'biaya_setup',
        'biaya_bulanan',
        'biaya_cloud',
        'share_fee',
    ];

    public function getKlienProduk($id)
    {

        $edit = $this->db->table('klien_produk');
        $edit->select('klien_produk.*');
        $edit->where('id_klien_produk', $id);
        $query = $edit->get();

        return $query->getResult();
    }
}

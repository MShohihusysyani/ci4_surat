<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'nama_produk',
        'deskripsi',
        'status_produk',
        'perusahaan',
        'logo_produk'
    ];

    public function getProduk($id)
    {

        $edit = $this->db->table('produk');
        $edit->select('produk.*');
        $edit->where('id_produk', $id);
        $query = $edit->get();

        return $query->getResult();
    }
}

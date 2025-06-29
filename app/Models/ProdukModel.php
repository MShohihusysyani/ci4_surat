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

    public function getProdukByPerusahaan($perusahaan)
    {
        return $this->db->table('produk')
            ->where('perusahaan', $perusahaan)
            ->get()
            ->getResult();
    }

    // Hitung total produk
    public function total_produk()
    {
        $query = $this->db->query("SELECT COUNT(id_produk) AS total_produk FROM produk");
        return $query->getResult();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table            = 'perusahaan';
    protected $primaryKey       = 'id_perusahaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_perusahaan',
        'npwp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'dati2',
        'no_telp',
        'email',
        'website',
        'instagram',
        'facebook',
        'youtube',
        'twitter',
        'tiktok',
        'logo'
    ];

    public function getPerusahaan($id)
    {

        return $this->db->table('perusahaan')
            ->select('perusahaan.*')
            ->where('id_perusahaan', $id)
            ->get()
            ->getRowArray();
    }
}

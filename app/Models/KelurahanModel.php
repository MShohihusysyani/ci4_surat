<?php

namespace App\Models;

use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table            = 'wilayah_kelurahan';
    protected $primaryKey       = 'id_wilayah_kelurahan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kelurahan',
        'kode_pos',
    ];

    public function getKelurahanById($kelurahanId)
    {
        return $this->where('id_wilayah_kelurahan', $kelurahanId)->first();
    }
}

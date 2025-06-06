<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table            = 'wilayah_propinsi';
    protected $primaryKey       = 'id_wilayah_propinsi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_propinsi'
    ];

    public function getProvinsiById($id)
    {
        return $this->where('id_wilayah_propinsi', $id)->first();
    }
}

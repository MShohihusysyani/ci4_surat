<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table            = 'wilayah_kecamatan';
    protected $primaryKey       = 'id_wilayah_kecamatan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kecamatan',
        'id_wilayah_kabupaten'
    ];
}

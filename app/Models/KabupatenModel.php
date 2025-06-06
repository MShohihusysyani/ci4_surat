<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table            = 'wilayah_kabupaten';
    protected $primaryKey       = 'id_wilayah_kabupaten';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kabupaten',
        'id_wilayah_propinsi'
    ];
}

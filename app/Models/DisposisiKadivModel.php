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
}

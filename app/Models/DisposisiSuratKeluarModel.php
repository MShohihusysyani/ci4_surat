<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiSuratKeluarModel extends Model
{
    protected $table            = 'disposisi_surat_keluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_keluar_id',
        'user_id',
    ];
}

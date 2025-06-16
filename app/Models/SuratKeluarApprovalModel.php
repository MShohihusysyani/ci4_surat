<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarApprovalModel extends Model
{
    protected $table            = 'surat_keluar_approval';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_keluar_id',
        'user_id',
        'approved_at',
    ];

    public function getBySuratKeluarId($suratKeluarId)
    {
        return $this->where('surat_keluar_id', $suratKeluarId)->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratTugasApprovalModel extends Model
{
    protected $table            = 'surat_tugas_approval';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_tugas_id',
        'user_id',
        'approved_at'
    ];

    public function getBySuratTugasId($suratTugasId)
    {
        return $this->where('surat_tugas_id', $suratTugasId)->findAll();
    }
}

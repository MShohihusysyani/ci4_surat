<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiSuratTugasModel extends Model
{
    protected $table            = 'disposisi_surat_tugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_tugas_id',
        'user_id',
    ];

    public function simpanAtauUpdate($surat_id, $user_id, $data)
    {
        $existing = $this->where('surat_tugas_id', $surat_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing) {
            $this->where('surat_tugas_id', $surat_id)
                ->where('user_id', $user_id)
                ->set($data)
                ->update();
            return 'Updated';
        } else {
            $this->insert($data);
            return 'Created';
        }
    }
}

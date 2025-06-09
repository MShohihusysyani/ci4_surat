<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiAtasModel extends Model
{
    protected $table            = 'disposisi_atas';
    protected $primaryKey       = 'id_disposisi_atas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_masuk_id',
        'user_id',
    ];

    public function simpanAtauUpdate($suratId, $userId, $data)
    {
        $existing = $this->where('surat_masuk_id', $suratId)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            $this->where('surat_masuk_id', $suratId)
                ->where('user_id', $userId)
                ->set($data)
                ->update();
            return 'Updated';
        } else {
            $this->insert($data);
            return 'Created';
        }
    }
}

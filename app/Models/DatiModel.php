<?php

namespace App\Models;

use CodeIgniter\Model;

class DatiModel extends Model
{
    protected $table            = 'dati';
    protected $primaryKey       = 'id_dati';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'dati2'
    ];

    public function getDati()
    {
        return $this->db->table('dati')
            ->select('id_dati, dati2')
            ->get()
            ->getResultArray();
    }
}

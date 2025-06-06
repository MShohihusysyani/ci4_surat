<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'klien_id',
        'username',
        'password',
        'role',
        'divisi',
        'nama_user',
        'email',
        'no_hp',
        'foto',
        'tgl_register',
        'status_user'
    ];

    public function getData()
    {
        $user = $this->db->table('user');
        $user->select('id_user, username, nama_user, role, divisi, status_user');
        $user->orderBy('role', 'ASC');
        $query = $user->get();

        return $query->getResult();
    }

    public function getUser($id)
    {

        $edit = $this->db->table('user');
        $edit->select('user.*');
        $edit->where('id_user', $id);
        $query = $edit->get();

        return $query->getResult();
    }
    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

}

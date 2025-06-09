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

    public function getKadiv()
    {

        // Query untuk mengambil user yang sesuai dengan user_id di surat
        return $this->select('id_user, nama_user')
            ->where('role', 'kadiv')
            ->get()
            ->getResult();
    }

    public function getDirops()
    {

        // Query untuk mengambil user yang sesuai dengan user_id di surat
        return $this->select('id_user, nama_user')
            ->where('role', 'dirops')
            ->get()
            ->getResult();
    }

    public function getDirut()
    {
        // Query untuk mengambil user yang sesuai dengan user_id di surat
        return $this->select('id_user, nama_user')
            ->where('role', 'dirut')
            ->get()
            ->getResult();
    }

    public function getStaf($divisi)
    {
        // Query untuk mengambil user yang sesuai dengan user_id di surat
        return $this->select('id_user, nama_user')
            ->where('divisi', $divisi)
            ->where('role', 'staf')
            ->get()
            ->getResult();
    }

    public function getKadivNonCbs($divisi_cbs)
    {
        return $this->select('id_user, nama_user, divisi')
            ->where('role', 'kadiv')
            ->where('divisi !=', $divisi_cbs) // Ambil Kadiv dari CBS
            ->get()
            ->getResult();
    }
}

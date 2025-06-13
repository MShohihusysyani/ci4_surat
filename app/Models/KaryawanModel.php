<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id_karyawan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap',
        'nama_panggilan',
        'alamat',
        'no_hp',
        'email',
        'jenis_kelamin',
        'tgl_masuk',
        'tgl_keluar',
        'tempat_lahir',
        'tanggal_lahir',
        'nip',
        'nik',
        'jabatan_id',
        'perusahaan_id',
        'foto',
        'status',
        'status_karyawan',
    ];

    public function getData()
    {
        $karyawan = $this->db->table('karyawan');
        $karyawan->select('karyawan.*, jabatan.nama_jabatan, perusahaan.nama_perusahaan');
        $karyawan->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id');
        $karyawan->join('perusahaan', 'perusahaan.id_perusahaan = karyawan.perusahaan_id');
        $query = $karyawan->get();

        return $query->getResult();
    }

    public function getKaryawan($id)
    {

        $edit = $this->db->table('karyawan');
        $edit->select('karyawan.*');
        $edit->where('id_karyawan', $id);
        $query = $edit->get();

        return $query->getResult();
    }

    public function getPejabat()
    {
        $karyawan = $this->db->table('karyawan');
        $karyawan->select(' karyawan.id_karyawan, karyawan.nama_lengkap, jabatan.nama_jabatan');
        $karyawan->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id');
        $karyawan->whereIn('jabatan.nama_jabatan', ['Direktur Utama', 'Direktur Operasional', 'Asisten Direktur', 'Kadiv Core Banking']);
        $query = $karyawan->get();

        return $query->getResult();
    }

    public function getPenerbit($id_karyawan)
    {

        return $this->select('karyawan.nama_lengkap, jabatan.nama_jabatan')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('karyawan.id_karyawan', $id_karyawan)
            ->first();
    }
}

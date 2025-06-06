<?php

namespace App\Models;

use CodeIgniter\Model;

class KlienModel extends Model
{
    protected $table            = 'klien';
    protected $primaryKey       = 'id_klien';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'no_klien',
        'nama_klien',
        'jenis_klien',
        'status_klien',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'dati2',
        'jml_cabang',
        'nama_dirut',
        'no_hp_dirut',
        'nama_dirops',
        'nama_pic',
        'no_hp_pic',
        'no_telp',
        'email',
        'website',
        'tgl_bergabung',
        'tgl_nonaktif',
        'user_id'
    ];

    public function getData()
    {
        $builder = $this->db->table('klien');
        $builder->select('klien.*,wilayah_propinsi.nama_propinsi AS provinsi,  wilayah_kabupaten.nama_kabupaten AS kabupaten, wilayah_kecamatan.nama_kecamatan AS kecamatan, wilayah_kelurahan.nama_kelurahan AS kelurahan');
        $builder->join('wilayah_propinsi', 'klien.provinsi = wilayah_propinsi.id_wilayah_propinsi', 'left');
        $builder->join('wilayah_kabupaten', 'klien.kabupaten = wilayah_kabupaten.id_wilayah_kabupaten', 'left');
        $builder->join('wilayah_kecamatan', 'klien.kecamatan = wilayah_kecamatan.id_wilayah_kecamatan', 'left');
        $builder->join('wilayah_kelurahan', 'klien.kelurahan = wilayah_kelurahan.id_wilayah_kelurahan', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKlien($id)
    {

        return $this->db->table('klien')
            ->select('klien.*')
            ->where('id_klien', $id)
            ->get()
            ->getRowArray();
    }

    // Get All Klien asc
    public function getAllKlien()
    {
        return $this->db->table('klien')
            ->select('klien.*')
            ->orderBy('no_klien', 'asc')
            ->get()
            ->getResult();
    }
}

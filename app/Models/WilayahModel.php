<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah_propinsi'; // Table default, ganti sesuai kebutuhan
    protected $primaryKey       = 'id_wilayah_propinsi';

    public function getProvinsi()
    {
        return $this->db->table('wilayah_propinsi')
            ->select('id_wilayah_propinsi, nama_propinsi')
            ->get()
            ->getResultArray();
    }
    public function getKabupatenByProvinsi($provinsiId)
    {
        return $this->db->table('wilayah_kabupaten')
            ->where('id_wilayah_propinsi', $provinsiId)
            ->get()
            ->getResultArray();
    }

    public function getKecamatanByKabupaten($kabupatenId)
    {
        return $this->db->table('wilayah_kecamatan')
            ->where('id_wilayah_kabupaten', $kabupatenId)
            ->get()
            ->getResultArray();
    }

    public function getKelurahanByKecamatan($kecamatanId)
    {
        return $this->db->table('wilayah_kelurahan')
            ->where('id_wilayah_kecamatan', $kecamatanId)
            ->get()
            ->getResultArray();
    }

    public function getKabupatenByProvinsi2($provinsi_id)
    {
        return $this->db->table('wilayah_kabupaten')
            ->select('id_wilayah_kabupaten, nama_kabupaten')
            ->where('id_wilayah_propinsi', $provinsi_id)
            ->get()
            ->getResultArray();
    }

    // Fungsi untuk mengambil kecamatan berdasarkan id kabupaten
    public function getKecamatanByKabupaten2($kabupaten_id)
    {
        return $this->db->table('wilayah_kecamatan')
            ->select('id_wilayah_kecamatan, nama_kecamatan')
            ->where('id_wilayah_kabupaten', $kabupaten_id)
            ->get()
            ->getResultArray();
    }

    // Fungsi untuk mengambil kelurahan berdasarkan id kecamatan
    public function getKelurahanByKecamatan2($kecamatan_id)
    {
        return $this->db->table('wilayah_kelurahan')
            ->select('id_wilayah_kelurahan, nama_kelurahan')
            ->where('id_wilayah_kecamatan', $kecamatan_id)
            ->get()
            ->getResultArray();
    }

    public function getKodeposByKelurahan($kelurahan_id)
    {
        return $this->db->table('wilayah_kelurahan')
            ->select('id_wilayah_kelurahan, kode_pos')
            ->where('id_wilayah_kelurahan', $kelurahan_id)
            ->get()
            ->getResultArray();
    }
}

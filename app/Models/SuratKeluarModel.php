<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'surat_masuk_id',
        'nomor_surat_masuk',
        'template',
        'jenis_surat',
        'klien_id',
        'nama_klien',
        'tempat',
        'no_surat',
        'tgl_surat',
        'lampiran',
        'file_lampiran',
        'perihal',
        'konten',
        'penerbit_id',
        'progres',
        'status',
        'prioritas',
        'file_scan',
        'qrcode',
        'qrcode_dirops',
        'qrcode_kadiv',
        'tagas',
        'handle_by',
        'catatan_kadiv',
        'catatan_dirops',
        'catatan_dirut',
        'tgl_kirim',
        'waktu_kirim',
        'metod_kirim',
        'tgl_approve_kadiv',
        'tgl_approve_dirops',
        'tgl_approve_dirut',
        'tgl_arsip',
        'created_at',
        'updated_at',
        'user_id_input'

    ];

    public function getData()
    {

        $data = $this->db->table('surat_keluar');
        $data->select('surat_keluar.*');
        $data->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $query = $data->get();

        return $query->getResult();
    }

    public function getDataDraft()
    {
        $data = $this->db->table('surat_keluar');
        $data->select('surat_keluar.*');
        $data->where('progres', 'Draft');
        $data->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $query = $data->get();

        return $query->getResult();
    }

    public function getDisposisi()
    {
        $id_user = session()->get('id_user');

        $disposisi = $this->db->table('surat_keluar');
        $disposisi->select('surat_keluar.*');
        $disposisi->where('progres', 'Proses Approve');
        $disposisi->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $disposisi->join('disposisi_surat_keluar', 'surat_keluar.id_surat_keluar = disposisi_surat_keluar.surat_keluar_id', 'left');
        $disposisi->where('disposisi_surat_keluar.user_id', $id_user);
        $query = $disposisi->get();

        return $query->getResult();
    }

    public function getSuratByUser()
    {
        $id_user = session()->get('id_user');

        $surat = $this->db->table('surat_keluar');
        $surat->select('surat_keluar.*');
        $surat->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $surat->where('surat_keluar.user_id_input', $id_user);
        $query = $surat->get();

        return $query->getResult();
    }

    public function getSurat($id)
    {

        $edit = $this->db->table('surat_keluar');
        $edit->select('surat_keluar.*');
        $edit->where('id_surat_keluar', $id);
        $query = $edit->get();

        return $query->getResult();
    }

    public function getDetailByKode($kodeVerifikasi)
    {
        return $this->select('surat_keluar.*, karyawan.nama_lengkap, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id_karyawan = surat_keluar.penerbit_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('surat_keluar.qrcode', $kodeVerifikasi)
            ->first();
    }

    public function disposisi($id_surat)
    {
        $query = "UPDATE surat_keluar SET progres='Proses Approve'   where id_surat_keluar=$id_surat";
        return $this->db->query($query);
    }

    //DATA KLIEN
    public function getSuratKeluar()
    {
        $id_klien = session()->get('klien_id');
        $data = $this->db->table('surat_keluar');
        $data->select('surat_keluar.*');
        $data->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');
        $data->where('surat_keluar.klien_id', $id_klien);
        $data->where('surat_keluar.progres', 'Approve');
        $query = $data->get();

        return $query->getResult();
    }

    // Loporan serverside 
    // Method ambil data dengan filter dan paginasi (server-side DataTables)
    public function getDatatablesFiltered($start, $length, $search, $tgl_awal, $tgl_akhir, $klien_id, $progres)
    {
        $builder = $this->db->table($this->table);
        $builder->select('surat_keluar.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');

        // Filter pencarian global
        if (!empty($search)) {
            $builder->groupStart();
            $builder->like('surat_keluar.no_surat', $search);
            $builder->orLike('surat_keluar.perihal', $search);
            $builder->orLike('klien.nama_klien', $search);
            $builder->groupEnd();
        }

        // Filter tanggal terima
        if (!empty($tgl_awal)) {
            $builder->where('surat_keluar.created_at >=', $tgl_awal);
        }
        if (!empty($tgl_akhir)) {
            $builder->where('surat_keluar.created_at <=', $tgl_akhir);
        }

        // Filter klien
        if (!empty($klien_id)) {
            $builder->where('surat_keluar.klien_id', $klien_id);
        }

        // Filter produk
        if (!empty($progres)) {
            $builder->where('surat_keluar.progres', $progres);
        }

        // Pagination
        $builder->limit($length, $start);

        // Urut berdasarkan tanggal terima terbaru
        $builder->orderBy('surat_keluar.created_at', 'DESC');

        return $builder->get()->getResult();
    }

    // Hitung total data tanpa filter (untuk DataTables)
    public function countAll()
    {
        return $this->countAllResults(false);
    }

    // Hitung total data dengan filter (untuk DataTables)
    public function countFilteredFiltered($search, $tgl_awal, $tgl_akhir, $klien_id, $progres)
    {
        $builder = $this->db->table($this->table);
        $builder->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');

        if (!empty($search)) {
            $builder->groupStart();
            $builder->like('surat_keluar.no_surat', $search);
            $builder->orLike('surat_keluar.perihal', $search);
            $builder->orLike('klien.nama_klien', $search);
            $builder->groupEnd();
        }

        if (!empty($tgl_awal)) {
            $builder->where('surat_keluar.created_at >=', $tgl_awal);
        }
        if (!empty($tgl_akhir)) {
            $builder->where('surat_keluar.created_at <=', $tgl_akhir);
        }

        if (!empty($klien_id)) {
            $builder->where('surat_keluar.klien_id', $klien_id);
        }

        if (!empty($progres)) {
            $builder->where('surat_keluar.progres', $progres);
        }


        return $builder->countAllResults();
    }

    // Export data
    public function getFiltered($tanggal_awal = null, $tanggal_akhir = null, $nama_klien = null, $progres = null)
    {
        // Memulai query builder
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');

        // Filter berdasarkan rentang tanggal
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $builder->where('surat_keluar.created_at >=', $tanggal_awal);
            $builder->where('surat_keluar.created_at <=', $tanggal_akhir);
        }

        if ($nama_klien) {
            $builder->like('klien.nama_klien', $nama_klien);
        }

        if ($progres) {
            $builder->where('surat_keluar.progres', $progres);
        }

        // Mengambil data
        $query = $builder->get();
        return $query->getResult(); // <--- pastikan getResult() digunakan
    }

    public function getAll($nama_klien = null, $progres = null)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_keluar.klien_id', 'left');

        if (!empty($nama_klien)) {
            $builder->like('klien.nama_klien', $nama_klien);
        }

        if (!empty($progres)) {
            $builder->where('surat_keluar.progres', $progres);
        }

        return $builder->get()->getResult();
    }

    // Menghitung total surat
    public function total_surat_keluar_klien()
    {
        $klien_id = session()->get('klien_id');
        $query = $this->db->query("SELECT COUNT(id_surat_keluar) AS total_surat_keluar_klien FROM surat_keluar WHERE klien_id='$klien_id'");
        return $query->getResult();
    }

    public function total_surat_keluar()
    {
        $query = $this->db->query("SELECT COUNT(id_surat_keluar) AS total_surat_keluar FROM surat_keluar");
        return $query->getResult();
    }
}

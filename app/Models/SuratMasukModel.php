<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table            = 'surat_masuk';
    protected $primaryKey       = 'id_surat_masuk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'klien_id',
        'surat_dari',
        'no_surat',
        'tgl_surat',
        'tgl_terima',
        'perihal',
        'produk',
        'perusahaan',
        'tujuan_surat',
        'handler_surat',
        'prioritas_surat',
        'prioritas_pengerjaan',
        'status_surat',
        'progres_surat',
        'tags',
        'input_by',
        'open_at',
        'update_at',
        'tgl_disposisi_kadiv',
        'tgl_disposisi_dirops',
        'tgl_disposisi_dirut',
        'tgl_balas',
        'tgl_arsip',
        'file',
        'butuh_balas',
        'status_balas',
        'status_disposisi_dirut',
        'status_disposisi_dirops',
        'status_disposisi_kadiv',
        'catatan_finish',
        'catatan_kadiv',
        'catatan_dirops',
        'catatan_dirut',
        'disposisi_kadiv',
        'disposisi_dirops',
        'disposisi_dirut',
        'user_id_input',
    ];

    // SERVERSIDE DATATABLE
    public function getDatatables()
    {
        $request = service('request');
        $search = $request->getPost('search')['value'] ?? null;
        $order = $request->getPost('order');
        $columns = $request->getPost('columns');

        $builder = $this->select('surat_masuk.id_surat_masuk, surat_masuk.surat_dari, surat_masuk.no_surat, surat_masuk.tgl_surat, 
        surat_masuk.tgl_terima, surat_masuk.perihal, surat_masuk.produk, surat_masuk.perusahaan, 
        surat_masuk.tujuan_surat, surat_masuk.handler_surat, surat_masuk.status_surat, 
        surat_masuk.progres_surat, surat_masuk.tags, surat_masuk.input_by, surat_masuk.file, 
        surat_masuk.butuh_balas, surat_masuk.status_balas, klien.nama_klien')
            ->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('surat_masuk.no_surat', $search)
                ->orLike('surat_masuk.perihal', $search)
                ->orLike('klien.nama_klien', $search)
                ->groupEnd();
        }

        // Default order
        $orderField = 'surat_masuk.tgl_terima';
        $orderDir = 'desc';

        if ($order && isset($order[0]['column']) && isset($order[0]['dir']) && isset($columns[$order[0]['column']]['data'])) {
            $orderField = $columns[$order[0]['column']]['data'];
            $orderDir = $order[0]['dir'];
        }

        $builder->orderBy($orderField, $orderDir);
        return $builder;
    }

    public function getDataTablesResult()
    {
        $builder = $this->getDatatables();

        // Cast ke int agar tidak error
        $length = isset($_POST['length']) ? (int)$_POST['length'] : 10;
        $start  = isset($_POST['start']) ? (int)$_POST['start'] : 0;

        if ($length != -1) {
            $builder->limit($length, $start);
        }

        return $builder->get()->getResult();
    }

    public function countFiltered()
    {
        return $this->getDatatables()->countAllResults(false);
    }

    public function countAllData()
    {
        return $this->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left')->countAllResults();
    }

    public function disposisiKeKadiv($id_surat, $nama_user)
    {

        $query = "UPDATE surat_masuk SET progres_surat='Proses Disposisi', handler_surat='$nama_user' WHERE id_surat_masuk=$id_surat";
        return $this->db->query($query);
    }

    // Disposisi Surat
    public function updateCatatanKadiv($idSurat, $catatan)
    {
        return $this->update($idSurat, ['catatan_kadiv' => $catatan]);
    }

    public function updateCatatanDirops($idSurat, $catatan)
    {
        return $this->update($idSurat, ['catatan_dirops' => $catatan]);
    }

    public function disposisiKeatasan($id_surat, $nama_user)
    {
        $query = "UPDATE surat_masuk SET progres_surat='Proses Disposisi', handler_surat='$nama_user' WHERE id_surat_masuk=$id_surat";
        return $this->db->query($query);
    }

    public function updateDisposisiDirutText($id_surat, $disposisi_text)
    {
        return $this->update($id_surat, ['disposisi_dirut' => $disposisi_text]);
    }

    public function disposisi_kedirops($id_surat, $nama_user)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d');

        $query = "UPDATE surat_masuk SET progres_surat='Proses Disposisi', tgl_disposisi_dirut='$now', handler_surat='$nama_user', status_disposisi_dirut='sudah disposisi'  where id_surat_masuk=$id_surat";
        return $this->db->query($query);
    }

    public function updateDisposisiDiropsText($id_surat, $disposisi_text)
    {
        return $this->update($id_surat, ['disposisi_dirops' => $disposisi_text]);
    }

    public function disposisi_kekadiv($id_surat, $nama_user)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d');

        $query = "UPDATE surat_masuk SET progres_surat='Proses Disposisi', tgl_disposisi_dirops='$now', handler_surat='$nama_user', status_disposisi_dirops='sudah disposisi'  where id_surat_masuk=$id_surat";
        return $this->db->query($query);
    }

    public function updateDisposisiKadivText($id_surat, $disposisi_text)
    {
        return $this->update($id_surat, ['disposisi_kadiv' => $disposisi_text]);
    }

    public function disposisi_kestaf($id_surat, $nama_user)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d');

        $query = "UPDATE surat_masuk SET progres_surat='Handle', tgl_disposisi_kadiv='$now', handler_surat='$nama_user', status_disposisi_kadiv='sudah disposisi'  where id_surat_masuk=$id_surat";
        return $this->db->query($query);
    }

    // KLIEN
    public function getSurat()
    {
        $klien_id  = session()->get('klien_id');
        $builder = $this->table('surat_masuk');
        $builder->select('id_surat_masuk, surat_dari, no_surat, tgl_surat, perihal, produk, perusahaan, tujuan_surat, handler_surat, status_surat, progres_surat, tags, input_by, file, butuh_balas, status_balas ');
        $builder->whereIn('progres_surat', ['Proses', 'Proses Disposisi', 'Handle', 'Finish']);
        $builder->where('klien_id', $klien_id);
        $query = $builder->get();

        // Kembalikan hasil query
        return $query->getResult();
    }

    public function getSuratById($id)
    {

        $edit = $this->db->table('surat_masuk');
        $edit->select('surat_masuk.*');
        $edit->where('id_surat_masuk', $id);
        $query = $edit->get();

        return $query->getResult();
    }

    // BALAS
    public function getBalas($id)
    {
        $balas = $this->db->table('surat_masuk');
        $balas->select('surat_masuk.* , klien.nama_klien');
        $balas->join('klien', 'klien.id_klien = surat_masuk.klien_id');
        $balas->where('surat_masuk.id_surat_masuk', $id);
        $query = $balas->get();

        return $query->getRow();
    }

    // Tambah
    public function getSuratByUser()
    {
        $user_id  = session()->get('id_user');
        $builder = $this->table('surat_masuk');
        $builder->select('surat_masuk.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id');
        $builder->where('progres_surat', 'Proses');
        $builder->where('user_id_input', $user_id);
        $query = $builder->get();

        // Kembalikan hasil query
        return $query->getResult();
    }

    // Loporan serverside 
    // Method ambil data dengan filter dan paginasi (server-side DataTables)
    public function getDatatablesFiltered($start, $length, $search, $tgl_awal, $tgl_akhir, $klien_id, $progres)
    {
        $builder = $this->db->table($this->table);
        $builder->select('surat_masuk.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');

        // Filter pencarian global
        if (!empty($search)) {
            $builder->groupStart();
            $builder->like('surat_masuk.no_surat', $search);
            $builder->orLike('surat_masuk.perihal', $search);
            $builder->orLike('klien.nama_klien', $search);
            $builder->groupEnd();
        }

        // Filter tanggal terima
        if (!empty($tgl_awal)) {
            $builder->where('surat_masuk.tgl_terima >=', $tgl_awal);
        }
        if (!empty($tgl_akhir)) {
            $builder->where('surat_masuk.tgl_terima <=', $tgl_akhir);
        }

        // Filter klien
        if (!empty($klien_id)) {
            $builder->where('surat_masuk.klien_id', $klien_id);
        }

        // Filter produk
        if (!empty($progres)) {
            $builder->where('surat_masuk.progres_surat', $progres);
        }

        // Pagination
        $builder->limit($length, $start);

        // Urut berdasarkan tanggal terima terbaru
        $builder->orderBy('surat_masuk.tgl_terima', 'DESC');

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
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');

        if (!empty($search)) {
            $builder->groupStart();
            $builder->like('surat_masuk.no_surat', $search);
            $builder->orLike('surat_masuk.perihal', $search);
            $builder->orLike('klien.nama_klien', $search);
            $builder->groupEnd();
        }

        if (!empty($tgl_awal)) {
            $builder->where('surat_masuk.tgl_terima >=', $tgl_awal);
        }
        if (!empty($tgl_akhir)) {
            $builder->where('surat_masuk.tgl_terima <=', $tgl_akhir);
        }

        if (!empty($klien_id)) {
            $builder->where('surat_masuk.klien_id', $klien_id);
        }

        if (!empty($progres)) {
            $builder->where('surat_masuk.progres_surat', $progres);
        }


        return $builder->countAllResults();
    }

    // Export data
    public function getFiltered($tanggal_awal = null, $tanggal_akhir = null, $nama_klien = null, $progres = null)
    {
        // Memulai query builder
        $builder = $this->db->table('surat_masuk');
        $builder->select('surat_masuk.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');

        // Filter berdasarkan rentang tanggal
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $builder->where('surat_masuk.tgl_terima >=', $tanggal_awal);
            $builder->where('surat_masuk.tgl_terima <=', $tanggal_akhir);
        }

        if ($nama_klien) {
            $builder->like('klien.nama_klien', $nama_klien);
        }

        if ($progres) {
            $builder->where('surat_masuk.progres_surat', $progres);
        }

        // Mengambil data
        $query = $builder->get();
        return $query->getResult(); // <--- pastikan getResult() digunakan
    }

    public function getAll($nama_klien = null, $progres = null)
    {
        $builder = $this->db->table('surat_masuk');
        $builder->select('surat_masuk.*, klien.nama_klien');
        $builder->join('klien', 'klien.id_klien = surat_masuk.klien_id', 'left');

        if (!empty($nama_klien)) {
            $builder->like('klien.nama_klien', $nama_klien);
        }

        if (!empty($progres)) {
            $builder->where('surat_masuk.progres_surat', $progres);
        }

        return $builder->get()->getResult();
    }
}

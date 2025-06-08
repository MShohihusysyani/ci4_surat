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
        $edit->select('id_surat_masuk, tgl_surat, no_surat, perihal, file');
        $edit->where('id_surat_masuk', $id);
        $query = $edit->get();

        return $query->getResult();
    }
}

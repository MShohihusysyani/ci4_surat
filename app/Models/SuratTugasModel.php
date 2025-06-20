<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratTugasModel extends Model
{
    protected $table            = 'surat_tugas';
    protected $primaryKey       = 'id_surat_tugas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'no_surat',
        'nama_sekretaris',
        'pic',
        'anggota',
        'unit_kerja',
        'tempat',
        'alamat',
        'tugas',
        'kendaraan',
        'beban_biaya',
        'lama_bertugas',
        'tgl_bertugas',
        'jam_tugas',
        'tgl_berangkat',
        'jam_berangkat',
        'tgl_kembali',
        'jam_kembali',
        'lpj',
        'laporan',
        'keterangan',
        'status',
        'progres',
        'catatan_kadiv',
        'catatan_dirops',
        'catatan_dirut',
        'tgl_approve_dirut',
        'qrcode',
        'created_at',

    ];

    public function generateNomorSurat()
    {
        $currentYear = date('Y');

        // Cek nomor surat terakhir di tahun ini berdasarkan parsing tahun dari nomor_surat
        $lastSurat = $this->like('no_surat', "/{$currentYear}", 'before')
            ->orderBy('no_surat', 'DESC')
            ->first();

        if ($lastSurat) {
            // Ambil nomor urut dari surat terakhir dan tambahkan 1
            $lastNomor = (int) substr($lastSurat->no_surat, 0, 3);
            $newNomor = $lastNomor + 1;
        } else {
            // Reset nomor jika tidak ada surat di tahun ini
            $newNomor = 1;
        }

        // Format bulan dalam angka romawi
        $bulanRomawi = [
            'I',
            'II',
            'III',
            'IV',
            'V',
            'VI',
            'VII',
            'VIII',
            'IX',
            'X',
            'XI',
            'XII'
        ];
        $bulan = $bulanRomawi[date('n') - 1];

        // Format nomor surat
        $formattedNomorSurat = str_pad($newNomor, 3, '0', STR_PAD_LEFT) . "/MSO-SPPK/{$bulan}/{$currentYear}";

        return $formattedNomorSurat;
    }

    public function getSurat($id)
    {

        $edit = $this->db->table('surat_tugas');
        $edit->select('surat_tugas.*');
        $edit->where('id_surat_tugas', $id);
        $query = $edit->get();

        return $query->getResult();
    }
}

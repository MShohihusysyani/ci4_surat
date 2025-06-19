<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratTugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_tugas'     => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_surat'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'nama_sekretaris'    => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'pic'                => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'anggota'            => [
                'type'           => 'TEXT',
            ],
            'unit_kerja'         => [
                'type'           => 'TEXT',
            ],
            'tempat'             => [
                'type'           => 'TEXT',
            ],
            'alamat'             => [
                'type'           => 'TEXT',
            ],
            'tugas'              => [
                'type'           => 'TEXT',
            ],
            'kendaraan'          => [
                'type'           => 'TEXT',
            ],
            'beban_biaya'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'lama_bertugas'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'tgl_bertugas'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'jam_tugas'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'tgl_berangkat'      => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'jam_berangkat'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'tgl_kembali'        => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'jam_kembali'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'lpj'                => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'laporan'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'keterangan'         => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'status'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'default'        => 'belum dibaca',
            ],
            'progres'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'catatan_kadiv'      => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'catatan_dirops'     => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'catatan_dirut'      => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'tgl_approve_dirut'  => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'qrcode'             => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id_surat_tugas', true);
        $this->forge->createTable('surat_tugas');
    }

    public function down()
    {
        $this->forge->dropTable('surat_tugas');
    }
}

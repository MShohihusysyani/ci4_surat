<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keluar'    => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'surat_masuk_id'     => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true
            ],
            'nomor_surat_masuk'  => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true
            ],
            'template'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true
            ],
            'jenis_surat'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true
            ],
            'klien_id'           => [
                'type'           => 'INT',
                'null'           => true
            ],
            'nama_klien'         => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'tempat'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true
            ],
            'no_surat'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'tgl_surat'          => [
                'type'           => 'DATE',
            ],
            'perihal'            => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'lampiran'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'file_lampiran'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'konten'             => [
                'type'           => 'TEXT',
            ],
            'penerbit_id'        => [
                'type'           => 'INT',
            ],
            'progres'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'status'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'default'        => 'belum dibaca'
            ],
            'prioritas'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true
            ],
            'file_scan'          => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'qrcode'             => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'qrcode_dirops'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'qrcode_kadiv'       => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'tags'               => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'handle_by'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'catatan_kadiv'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'catatan_dirops'     => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'catatan_dirut'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'tgl_kirim'          => [
                'type'           => 'DATE',
                'null'           => true
            ],
            'waktu_kirim'        => [
                'type'           => 'TIME',
                'null'           => true
            ],
            'metode_kirim'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true
            ],
            'tgl_approve_kadiv'  => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'tgl_approve_dirops' => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'tgl_approve_dirut'  => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'tgl_arsip'          => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'user_id_input'      => [
                'type'           => 'INT',
                'null'           => true
            ],
        ]);

        $this->forge->addKey('id_surat_keluar', true);
        $this->forge->createTable('surat_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('surat_keluar');
    }
}

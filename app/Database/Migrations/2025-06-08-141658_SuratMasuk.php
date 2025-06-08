<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type'            => 'INT',
                'unsigned'        => true,
                'auto_increment'  => true
            ],
            'klien_id' => [
                'type'            => 'INT',
                'null'            => true,
                'null'            => true
            ],
            'surat_dari' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'no_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'tgl_surat' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'perihal' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'file' => [
                'type'            => 'TEXT',
            ],
            'tgl_terima' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'butuh_balas' => [
                'type'            => 'VARCHAR',
                'constraint'      => 20,
                'null'            => true
            ],
            'status_balas' => [
                'type'            => 'VARCHAR',
                'constraint'      => 50,
                'default'         => 'belum dibalas'
            ],
            'tgl_balas' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'prioritas_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 50,
                'null'            => true
            ],
            'tujuan_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'status_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'default'         => 'Belum dibaca'
            ],
            'progres_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'default'         => 'Proses'
            ],
            'produk' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'perusahaan' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'handler_surat' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'prioritas_pengerjaan' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'tgl_disposisi_kadiv' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'status_disposisi_kadiv' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'default'         => 'belum disposisi'
            ],
            'catatan_kadiv' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'disposisi_kadiv' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'tgl_disposisi_dirops' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'status_disposisi_dirops' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'default'         => 'belum disposisi'
            ],
            'catatan_dirops' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'disposisi_dirops' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'tgl_disposisi_dirut' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'status_disposisi_dirut' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'default'         => 'belum disposisi'
            ],
            'catatan_dirut' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'disposisi_dirut' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'catatan_finish' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'tgl_arsip' => [
                'type'            => 'DATE',
                'null'            => true
            ],
            'open_at' => [
                'type'            => 'DATETIME',
                'null'            => true,
                'default'         => null
            ],
            'update_at' => [
                'type'            => 'DATETIME',
                'null'            => true,
            ],
            'tags' => [
                'type'            => 'TEXT',
                'null'            => true
            ],
            'input_by' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'user_id' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
            'user_id_input' => [
                'type'            => 'VARCHAR',
                'constraint'      => 128,
                'null'            => true
            ],
        ]);

        $this->forge->addKey('id_surat_masuk', true);
        $this->forge->createTable('surat_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}

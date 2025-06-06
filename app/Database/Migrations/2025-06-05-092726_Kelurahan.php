<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelurahan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_wilayah_kelurahan' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'id_wilayah_kecamatan' => [
                'type'           => 'INT',
            ],
            'nama_kelurahan'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'kode_pos'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_wilayah_kelurahan', TRUE);

        // Membuat tabel user
        $this->forge->createTable('wilayah_kelurahan', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('wilayah_kelurahan');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kabupaten extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_wilayah_kabupaten' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'id_wilayah_propinsi' => [
                'type'           => 'INT',
            ],
            'nama_kabupaten'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'ibukota'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'k_bsni'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_wilayah_kabupaten', TRUE);

        // Membuat tabel user
        $this->forge->createTable('wilayah_kabupaten', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('wilayah_kabupaten');
    }
}

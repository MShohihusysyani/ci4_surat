<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provinsi extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_wilayah_propinsi' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'nama_propinsi'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'ibukota'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'p_bsni'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_wilayah_propinsi', TRUE);

        // Membuat tabel user
        $this->forge->createTable('wilayah_propinsi', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('wilayah_propinsi');
    }
}

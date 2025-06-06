<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kecamatan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_wilayah_kecamatan' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'id_wilayah_kabupaten' => [
                'type'           => 'INT',
            ],
            'nama_kecamatan'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_wilayah_kecamatan', TRUE);

        // Membuat tabel user
        $this->forge->createTable('wilayah_kecamatan', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('wilayah_kecamatan');
    }
}

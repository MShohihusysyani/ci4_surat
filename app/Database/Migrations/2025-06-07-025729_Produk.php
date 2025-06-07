<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel produk
        $this->forge->addField([
            'id_produk'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'nama_produk'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ],
            'deskripsi'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'status_produk'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true

            ],
            'perusahaan'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'logo_produk'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],

        ]);

        // Membuat primary key
        $this->forge->addKey('id_produk', TRUE);

        // Membuat tabel produk
        $this->forge->createTable('produk', TRUE);
    }

    public function down()
    {
        // menghapus tabel produk
        $this->forge->dropTable('produk');
    }
}

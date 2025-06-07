<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KlienProduk extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_klien_produk'    => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'no_klien'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
                'null'           => true,
            ],
            'nama_klien'         => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'nama_produk'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'deskripsi'          => [
                'type'           => 'TEXT',
            ],
            'tgl_pakai'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'tgl_jatuh_tempo'    => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'jangka_waktu'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'biaya_setup'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'biaya_bulanan'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'biaya_cloud'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'share_fee'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],

        ]);

        // Membuat primary key
        $this->forge->addKey('id_klien_produk', TRUE);

        // Membuat tabel user
        $this->forge->createTable('klien_produk', TRUE);
    }

    public function down()
    {
        // menghapus tabel menu
        $this->forge->dropTable('klien_produk');
    }
}

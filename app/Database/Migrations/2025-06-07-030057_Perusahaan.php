<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perusahaan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_perusahaan'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'nama_perusahaan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'npwp'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '120',
                'null'           => true
            ],
            'alamat'             => [
                'type'           => 'TEXT',
            ],
            'provinsi'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'kabupaten'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'kecamatan'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'kelurahan'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'kode_pos'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'dati2'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'logo'               => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'no_telp'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'website'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'instagram'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'facebook'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'youtube'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'twitter'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'tiktok'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_perusahaan', TRUE);

        // Membuat tabel user
        $this->forge->createTable('perusahaan', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('perusahaan');
    }
}

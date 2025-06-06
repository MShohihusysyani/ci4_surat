<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Klien extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_klien'            => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'no_klien'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'           => true,
            ],
            'nama_klien'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ],
            'jenis_klien'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'status_klien'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true
            ],
            'alamat'               => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'provinsi'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'kabupaten'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'kecamatan'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'kelurahan'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'kode_pos'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true
            ],
            'dati2'              => [
                'type'           => 'INT',
                'null'           => true,
            ],
            'jml_cabang'         => [
                'type'           => 'INT',
                'null'           => true,
            ],
            'nama_dirut'         => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'no_hp_dirut'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true,
            ],
            'nama_dirops'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'nama_pic'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'no_hp_pic'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'           => true,
            ],
            'no_telp'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'website'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true
            ],
            'tgl_bergabung'      => [
                'type'           => 'DATE',
                'null'           => true
            ],
            'tgl_nonaktif'       => [
                'type'           => 'DATE',
                'null'           => true
            ],
            'user_id'            => [
                'type'           => 'INT',
                'null'           => true
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_klien', TRUE);

        // Membuat tabel user
        $this->forge->createTable('klien', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('klien');
    }
}

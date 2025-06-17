<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel user
        $this->forge->addField([
            'id_user'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'klien_id'           => [
                'type'           => 'INT',
                'constraint'     => 5,
                'null'           => true,
            ],
            'karyawan_id'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'null'           => true,
            ],
            'username'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '50'
            ],
            'password'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'role'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'divisi'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'nama_user'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'no_hp'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
            'foto'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'tgl_register'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'tgl_nonaktif'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'status_user'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'last_login'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_user', TRUE);

        // Membuat tabel user
        $this->forge->createTable('user', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('user');
    }
}

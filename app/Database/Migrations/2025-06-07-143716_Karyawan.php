<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_karyawan'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'nama_lengkap'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'nama_panggilan'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'alamat'             => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'tempat_lahir'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'tanggal_lahir'      => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'no_hp'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'jenis_kelamin'      => [
                'type'           => 'ENUM',
                'constraint'     => ['L', 'P'],
                'null'           => true,
            ],
            'tgl_masuk'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'tgl_keluar'         => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'status'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'default'        => 'Aktif',
                'null'           => true,
            ],
            'status_karyawan'    => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'nip'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'nik'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'jabatan_id'         => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'perusahaan_id'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
                'null'           => true,
            ],
            'foto'               => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_karyawan', TRUE);


        // Membuat tabel user
        $this->forge->createTable('karyawan', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('karyawan');
    }
}

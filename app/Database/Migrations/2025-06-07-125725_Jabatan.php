<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jabatan'         => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_jabatan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
            ],
            'level_jabatan'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id_jabatan', true);
        $this->forge->createTable('jabatan', true);
    }

    public function down()
    {
        $this->forge->dropTable('jabatan', true);
    }
}

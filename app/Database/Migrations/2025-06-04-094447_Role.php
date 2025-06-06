<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_role'            => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'nama_role'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_role', TRUE);

        // Membuat tabel user
        $this->forge->createTable('role', TRUE);
    }

    public function down()
    {
        // menghapus tabel role
        $this->forge->dropTable('role');
    }
}

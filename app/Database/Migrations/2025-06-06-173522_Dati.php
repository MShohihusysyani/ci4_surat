<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dati extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dati' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dati2' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_dati', true);
        $this->forge->createTable('dati', true);
    }

    public function down()
    {
        $this->forge->dropTable('dati', true);
    }
}

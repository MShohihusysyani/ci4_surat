<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluarApproval extends Migration
{
    public function up()
    {
        // 2. Buat tabel surat_keluar_approval
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'surat_keluar_id' => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('surat_keluar_id', 'surat_keluar', 'id_surat_keluar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_keluar_approval');
    }

    public function down()
    {
        $this->forge->dropTable('surat_keluar_approval');
    }
}

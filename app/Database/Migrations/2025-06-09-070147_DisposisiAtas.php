<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DisposisiAtas extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_disposisi_atas'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'surat_masuk_id'       => [
                'type'           => 'INT'
            ],
            'user_id'       => [
                'type'           => 'INT'
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_disposisi_atas', TRUE);

        // Membuat tabel user
        $this->forge->createTable('disposisi_atas', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('disposisi_atas');
    }
}

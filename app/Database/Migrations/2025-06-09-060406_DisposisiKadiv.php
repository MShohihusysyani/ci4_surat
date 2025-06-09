<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DisposisiKadiv extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_disposisi'          => [
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
        $this->forge->addKey('id_disposisi', TRUE);

        // Membuat tabel user
        $this->forge->createTable('disposisi_kadiv', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('disposisi_kadiv');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DisposisiSuratTugas extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true
            ],
            'surat_tugas_id'     => [
                'type'           => 'INT'
            ],
            'user_id'            => [
                'type'           => 'INT'
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel user
        $this->forge->createTable('disposisi_surat_tugas', TRUE);
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('disposisi_surat_tugas');
    }
}

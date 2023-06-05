<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        // Isi lah field, PK, FK serta Tabel
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '9',
            ],
            'nama_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jurusan_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'no_telp_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '13',
            ],
            'alamat_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_users' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_users_anggota');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}

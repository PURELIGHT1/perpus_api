<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_petugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'no_telp_petugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '13',
            ],
            'alamat_petugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_users' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_users_petugas');
        $this->forge->createTable('petugas');
    }

    public function down()
    {
        $this->forge->dropTable('petugas');
    }
}

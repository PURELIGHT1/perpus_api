<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_rak' => [
                'type'       => 'CHAR',
                'constraint' => '5',
            ],
            'lokasi_rak' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'id_buku' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_buku', 'buku', 'id', 'CASCADE', 'CASCADE', 'fk_buku_rak');
        $this->forge->createTable('rak');
    }

    public function down()
    {
        $this->forge->dropTable('rak');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_buku' => [
                'type'       => 'CHAR',
                'constraint' => '5',
            ],
            'judul_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'penulis_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'penerbit_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tahun_penerbit' => [
                'type'       => 'CHAR',
                'constraint' => '4',
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_users' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}

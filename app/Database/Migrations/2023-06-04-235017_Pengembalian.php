<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengembalian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'tanggal_pengembalian' => [
                'type'       => 'DATE',
                null         => true,
            ],
            'denda' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_buku' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_anggota' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_petugas' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_buku', 'buku', 'id', 'CASCADE', 'CASCADE', 'fk_buku_pengembalian');
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id', 'CASCADE', 'CASCADE', 'fk_anggota_pengembalian');
        $this->forge->addForeignKey('id_petugas', 'petugas', 'id', 'CASCADE', 'CASCADE', 'fk_petugas_pengembalian');
        $this->forge->createTable('pengembalian');
    }

    public function down()
    {
        $this->forge->dropTable('pengembalian');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'tanggal_pinjam' => [
                'type'       => 'DATE',
            ],
            'tanggal_kembali' => [
                'type'       => 'DATE',
                null         => true,
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
        $this->forge->addForeignKey('id_buku', 'buku', 'id', 'CASCADE', 'CASCADE', 'fk_buku_peminjaman');
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id', 'CASCADE', 'CASCADE', 'fk_anggota_peminjaman');
        $this->forge->addForeignKey('id_petugas', 'petugas', 'id', 'CASCADE', 'CASCADE', 'fk_petugas_peminjaman');
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}

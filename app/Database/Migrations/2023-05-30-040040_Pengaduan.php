<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengaduan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'       => 'INT',
                'constraint' => '15',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'tmpt_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'tgl_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'jns_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'jns_kasus' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'status_perkawinan' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'latitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'longitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan');
    }
}

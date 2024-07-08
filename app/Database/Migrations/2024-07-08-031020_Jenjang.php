<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Jenjang extends Migration
{
    protected $forge;
    public function __construct()
    {
        $this->forge = \Config\Database::forge();
    }
    public function up()
    {
        $this->forge->addField([
            'id_jenjang' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_peserta' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'jenjang' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_sekolah' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun_lulus' => [
                'type' => 'INT',
                'constraint' => 50,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_jenjang', true);
        $this->forge->addForeignKey('id_peserta', 'peserta', 'id_peserta');
        $this->forge->createTable('jenjang');
    }

    public function down()
    {
        $this->forge->dropTable('jenjang');
    }
}

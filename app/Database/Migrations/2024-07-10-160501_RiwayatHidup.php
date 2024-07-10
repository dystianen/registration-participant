<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class RiwayatHidup extends Migration
{
    protected $forge;
    public function __construct()
    {
        $this->forge = \Config\Database::forge();
    }
    public function up()
    {
        $this->forge->addField([
            'id_riwayat_hidup' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'nomor_ktp' => [
                'type' => 'INT',
                'constraint' => 100,
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin' => array(
                'type' => 'ENUM("LAKI-LAKI","PEREMPUAN")',
                'default' => 'LAKI-LAKI',
                'null' => FALSE,
            ),
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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

        $this->forge->addKey('id_riwayat_hidup', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user');
        $this->forge->createTable('riwayat_hidup');
    }

    public function down()
    {
        $this->forge->dropTable('riwayat_hidup');
    }
}

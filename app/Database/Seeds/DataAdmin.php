<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataAdmin extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email'  =>  "admin@gmail.com",
                'password'  =>  password_hash("admin", PASSWORD_DEFAULT),
                'nama_admin' => 'Administrator',
                'deleted_at' => null,
            ],
        ];
        $this->db->table('admin')->insertBatch($data);
    }
}

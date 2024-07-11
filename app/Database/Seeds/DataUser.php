<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataUser extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email'  =>  "admin@gmail.com",
                'password'  =>  password_hash("admin", PASSWORD_DEFAULT),
                'name' => 'Administrator',
                'role' => "ADMIN",
                'status' => null,
                'deleted_at' => null,
            ],
            [
                'email'  =>  "adis@gmail.com",
                'password'  =>  password_hash("adis", PASSWORD_DEFAULT),
                'name' => 'Adis',
                'status' => 'PENDING',
                'role' => "PESERTA",
                'deleted_at' => null,
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}

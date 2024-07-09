<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PesertaModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('/pages/login/index');
    }

    public function loginAuth()
    {
        $session = session();
        $pesertaModel = new PesertaModel();
        $adminModel = new AdminModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Check if the user is an admin
        $admin = $adminModel->where('email', $email)->first();
        if ($admin) {
            // Verify password for admin
            $password_hash = $admin['password'];
            $authenticatePassword = password_verify($password, $password_hash);
            if ($authenticatePassword) {
                $ses_data = [
                    'user_id' => $admin['id_admin'], // Change 'id' to the correct admin ID column name
                    'user_name' => $admin['nama_admin'], // Change 'name' to the correct admin name column name
                    'email' => $admin['email'],
                    'role' => 'admin'
                ];

                $session->set($ses_data);
                return redirect()->to(base_url('peserta'));
            } else {
                $session->setFlashdata('failed', 'Password is incorrect.');
                return redirect()->to(base_url('login'));
            }
        }

        // Check if the user is a peserta (non-admin user)
        $peserta = $pesertaModel
            ->where('email', $email)
            ->first();

        if ($peserta) {
            if ($peserta['status'] === "PENDING") {
                $session->setFlashdata('failed', 'Your account is pending approval.');
                return redirect()->to(base_url('login'));
            }

            if ($peserta['status'] === "APPROVED") {
                // Verify password for peserta (non-admin user)
                if (password_verify($password, $peserta['password'])) {
                    $ses_data = [
                        'user_id' => $peserta['id_peserta'], // Change 'id' to the correct peserta ID column name
                        'user_name' => $peserta['nama_peserta'], // Change 'name' to the correct peserta name column name
                        'email' => $peserta['email'],
                        'role' => 'peserta',
                    ];

                    $session->set($ses_data);
                    return redirect()->to(base_url('peserta'));
                } else {
                    $session->setFlashdata('failed', 'Password is incorrect.');
                    return redirect()->to(base_url('login'));
                }
            }
        } else {
            $session->setFlashdata('failed', 'User not found.');
            return redirect()->to(base_url('login'));
        }

        // If no user found with the provided email
        $session->setFlashdata('failed', 'Email does not exist.');
        return redirect()->to(base_url('/login'));
    }
}

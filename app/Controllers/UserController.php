<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('/pages/login/index');
    }

    public function loginView()
    {
        return view('/pages/login/index');
    }

    public function loginAuth()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $is_admin = $this->userModel
            ->where('email', $email)
            ->where('role', 'ADMIN')
            ->first();

        if ($is_admin) {
            if (password_verify($password, $is_admin['password'])) {
                $ses_data = [
                    'id_user' => $is_admin['id_user'],
                    'name' => $is_admin['name'],
                    'email' => $is_admin['email'],
                    'role' => $is_admin['role'],
                ];

                $session->set($ses_data);
                return redirect()->to(base_url('peserta'));
            } else {
                $session->setFlashdata('failed', 'Password is incorrect.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $peserta = $this->userModel
                ->where('email', $email)
                ->first();

            if ($peserta['status'] === "PENDING") {
                $session->setFlashdata('failed', 'Your account is pending approval.');
                return redirect()->to(base_url('login'));
            }

            if ($peserta['status'] === "APPROVED") {
                if (password_verify($password, $peserta['password'])) {
                    $ses_data = [
                        'id_user' => $peserta['id_user'],
                        'name' => $peserta['name'],
                        'email' => $peserta['email'],
                        'role' => $peserta['role'],
                    ];

                    $session->set($ses_data);
                    return redirect()->to(base_url('peserta'));
                } else {
                    $session->setFlashdata('failed', 'Password is incorrect.');
                    return redirect()->to(base_url('login'));
                }
            } else {
                $session->setFlashdata('failed', 'User not found.');
                return redirect()->to(base_url('login'));
            }
        }
    }

    public function registerView()
    {
        return view('/pages/registration/index');
    }

    public function registerAuth()
    {
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getVar('name'),
            'deleted_at' => null,
        ];

        $this->userModel->insert($data);
        $id_user = $this->userModel->insertID();
        session()->setFlashdata('success', 'Register Successfully.');
        return redirect()->to(base_url("/riwayat-hidup?id_user=" . $id_user));
    }

    public function waiting()
    {
        $id_user = $this->request->getVar('id_user');
        $is_approved = $this->userModel
            ->where('id_user', $id_user)
            ->where('status', 'APPROVED')
            ->first();

        if ($is_approved) {
            return redirect()->to(base_url("/login"));
        };

        return view('/pages/waiting/index');
    }
}

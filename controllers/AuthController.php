<?php
require_once 'models/User.php';

class AuthController {
    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function login() {
        if (isLoggedIn()) {
            $this->redirectBasedOnRole($_SESSION['user_role']);
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($login) || empty($password)) {
                $error = 'Email/Username dan Password harus diisi.';
            } else {
                $user = $this->userModel->authenticate($login, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_nama'] = $user['nama'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_email'] = $user['email'];
                    
                    $this->redirectBasedOnRole($user['role']);
                } else {
                    $error = 'Email/Username atau Password salah, atau akun tidak aktif.';
                }
            }
        }

        require 'views/auth/login.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /clinicv2/login');
        exit;
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case 'admin':
                header('Location: /clinicv2/admin/dashboard');
                break;
            case 'dokter':
                header('Location: /clinicv2/dokter/dashboard');
                break;
            case 'owner':
                header('Location: /clinicv2/owner/dashboard');
                break;
            default:
                header('Location: /clinicv2/login');
                break;
        }
        exit;
    }
}

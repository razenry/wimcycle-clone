<?php

class Auth
{
    public function index()
    {

        session_start();

        $data = [
            'title' => 'Login',
            'description' => 'Authentication user'
        ];

        App::view('admin/auth/index', $data, 'admin/auth/layouts/app');
    }

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = UserModel::getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] == 1) {
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['berhasil_login'] = "Selamat datang $email";

                    // Redirect based on role
                    if ($user['level'] === "Admin") {
                        header("Location: " . Routes::base('admin'));
                    } elseif ($user['level'] === "Officer") {
                        header("Location: " . Routes::base('admin'));
                    } elseif ($user['level'] === "Customer") {
                        header("Location: " . Routes::base('beranda'));
                    }
                    exit();
                } else {
                    $_SESSION['gagal'] = "Akun Anda tidak aktif. Hubungi administrator.";
                }
            } else {
                $_SESSION['gagal'] = "Gagal login. Email atau password salah.";
            }
        } else {
            $_SESSION['gagal'] = "Gagal login. Harap coba lagi.";
        }

        header("Location: " . Routes::base("auth"));
        exit();
    }
}

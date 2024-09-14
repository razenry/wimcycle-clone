<?php

class Auth
{
    public function index()
    {
        App::view("admin/auth/layouts/header");
        App::view("admin/auth/login");
        App::view("admin/auth/layouts/footer");
    }

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = App::model('User_model');
            $user = $userModel->getPetugas($email);

            // Memeriksa apakah pengguna dan password valid
            if ($user && password_verify($password, $user['password'])) {

                // Memeriksa status akun, hanya akun aktif yang dapat login
                if ($user['status'] == 1) {

                    if ($user['level'] == "pengguna") {

                        $_SESSION['login'] = "berhasil";
                        $_SESSION['user'] = $user;
                        $_SESSION['berhasil_login'] = "Selamat datang $email";

                        header("Location: " . Routes::base('beranda'));
                        exit();

                    } elseif ($user['level'] == "Admin" || "Petugas") {

                        $_SESSION['login'] = "berhasil";
                        $_SESSION['user'] = $user;
                        $_SESSION['berhasil_login'] = "Selamat datang $email";

                        header("Location: " . Routes::base('admin'));
                        exit();
                    }
                } else {
                    $_SESSION['gagal'] = "Akun Anda tidak aktif. Hubungi administrator.";
                    header("Location: " . Routes::base("admin/auth"));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Gagal login. Email atau password salah.";
                header("Location: " . Routes::base("admin/auth/email-invalid"));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Gagal login. Harap coba lagi.";
            header("Location: " . Routes::base("admin/auth/gagal-login"));
            exit();
        }
    }
}

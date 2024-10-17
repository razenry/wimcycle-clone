<?php


class Session
{
    public static function checkSession($params)
    {
        session_start();

        if ($params == "Admin") {
            // Check if user is logged in
            if (!isset($_SESSION['login']) || !$_SESSION['login']) {
                $_SESSION['gagal'] = "Anda belum login";
                header("Location: " . Routes::base('auth'));
                exit();
            }
    
            // Check if user is an admin or officer
            if ($_SESSION['user']['level'] === "Customer") {
                $_SESSION['gagal'] = "Anda tidak memiliki akses";
                header("Location: " . Routes::base());
                exit();
            }
        }

        if ($params == "Home") {
            // Check if user is logged in
            if (!isset($_SESSION['login']) || !$_SESSION['login']) {
                $_SESSION['gagal'] = "Anda belum login";
                header("Location: " . Routes::base('auth'));
                exit();
            }
    
            // Check if user is an admin or officer
            if ($_SESSION['user']['level'] === "Customer") {
                $_SESSION['gagal'] = "Anda tidak memiliki akses";
                header("Location: " . Routes::base());
                exit();
            }
        }


        // Optional: set session message for admins or officers
        $_SESSION['pesan'] = "Selamat Datang";
    }  
}

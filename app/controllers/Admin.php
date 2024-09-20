<?php

class Admin
{

    // Check Session Section

    public static function checkSession()
    {
        session_start();

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

        // Optional: set session message for admins or officers
        $_SESSION['pesan'] = "Selamat Datang";
    }

    // Dashboard Section

    public function index()
    {
        self::checkSession();

        // Set data for dashboard page
        $data['pageTitle'] = "Dashboard";
        $data['nav-link'] = true;

        // Display dashboard page
        App::view("admin/layouts/header");
        App::view("admin/layouts/navbar", $data);
        App::view("admin/layouts/page-header", $data);
        App::view("admin/index");
        App::view("admin/layouts/page-footer");
        App::view("admin/layouts/modal");
        App::view("admin/layouts/footer");
    }

    // Category Section

    public function category()
    {
        self::checkSession();

        // Check if there is a parameter for category index

        // Set data for category page
        $data['pageTitle'] = "Category";
        $data['nav-link'] = true;
        $data['categories'] = App::model("Category_model")->getAll();
        
        // Display category page
        App::view("admin/layouts/header", $data);
        App::view("admin/layouts/navbar", $data);
        App::view("admin/layouts/page-header", $data);
        App::view("admin/category/index", $data);
        App::view("admin/layouts/page-footer");
        App::view("admin/layouts/modal");
        App::view("admin/layouts/footer");
    }

    // Logout Section

    public function logout()
    {
        // Destroy session and redirect to login page
        session_start();
        session_destroy();
        unset($_SESSION);
        header("Location: " . Routes::base('auth'));
        exit();
    }
}

<?php

class Admin
{
    public function index()
    {

        Session::checkSession("Admin");
        header("Location:" . Routes::base('admin/dashboard'));
    }

    public function dashboard()
    {

        Session::checkSession("Admin");

        $data = [
            'title' => 'Dashboard',
            'link' => 'Dashboard',
            'description' => 'Dashboard Page!',
            'motivation' => ExtendsHelper::getMotivation(),
            'navLink' => true,

        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('admin/index', $data, 'admin/layouts/app');
    }

    // Product Section

    public function category()
    {
        Session::checkSession("Admin");

        $data = [
            'title' => 'Category',
            'link' => 'Product',
            'description' => 'Category Page!',
            'categories' => CategoryModel::all(),
            'navLink' => true
        ];

        App::view('admin/category/index', $data, 'admin/layouts/app');
    }

    public function frame()
    {
        Session::checkSession("Admin");

        $data = [
            'title' => 'Frame',
            'link' => 'Product',
            'description' => 'Frame Page!',
            'frames' => FrameModel::all(),
            'navLink' => true
        ];

        App::view('admin/frame/index', $data, 'admin/layouts/app');
    }



    // Page section
    public function slide()
    {
        Session::checkSession("Admin");

        $data = [
            'title' => 'Slides',
            'dscription' => 'Slides Page!',
            'link' => 'Pages',
            'navLink' => true,
            'slides' => SlideModel::all()

        ];

        App::view("admin/slide/index", $data, 'admin/layouts/app');
    }

    public function product()
    {
        Session::checkSession("Admin");

        $data = [
            'title' => 'Product',
            'dscription' => 'Product Page!',
            'link' => 'Product',
            'navLink' => true,
            'products' => ProductModel::all()
        ];

        App::view("admin/product/index", $data, 'admin/layouts/app');
    }


    public function test()
    {

        echo CurrencyFormatter::formatCurrency(10, 'JPY');

        var_dump(ProductModel::all());
    }

    public function logout()
    {
        Session::checkSession('Admin');
        session_destroy();
        unset($_SESSION);
        header("Location:" . Routes::base('auth'));
        exit();
    }
}

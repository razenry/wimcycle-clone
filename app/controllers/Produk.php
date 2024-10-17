<?php

class Produk
{
    public function index($params)
    {

        $category_slug = self::bind($params);

        // Jika kategori tidak ada, redirect ke homepage
        if (!$category_slug) {
            header('Location: '. Routes::base('beranda'));
            exit;
        }else{
            $_SESSION['gagal'] = "Akses Ditolak";
            header('Location: '. Routes::base('beranda'));
            exit;

        }

    }

    public function detail($slug)
    {
        $slug = self::bind($slug);

        // Jika slug tidak ada, redirect ke homepage
        if (!$slug) {
            header('Location: '. Routes::base('beranda'));
            exit;
        }

        $record = ProductModel::getBySlug($slug);

        // die(var_dump($record));

        // Jika record tidak ada, redirect ke homepage
        if (!$record) {
            header('Location: '. Routes::base('beranda'));
            exit;
        }

        $name = $record['product_name'];

        $data = [
            'title' => "Detail $name",
            'description' => "Detail Produk $name!",
            'product' => $record
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/produk/detail', $data, 'home/layouts/app');

    }


    public static function bind($params)
    {
        $post = $params[0] ?? null;
        return $post;
    }
}

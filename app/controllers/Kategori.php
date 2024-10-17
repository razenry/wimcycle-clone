<?php

class Kategori
{
    public function index($params)
    {

        $category_slug = $params[0] ?? null;

        // Jika kategori tidak ada, redirect ke homepage
        if (!$category_slug) {
            header('Location: '. Routes::base('beranda'));
            exit;
        }
        // Data yang akan dikirimkan ke view
        $data = [
            'title' => 'Homepage',
            'description' => 'Category Page!',
            'categories' => CategoryModel::getAllBySlug($category_slug)
        ];

        // die(var_dump($data));

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/category/index', $data, 'home/layouts/app');
    }
}

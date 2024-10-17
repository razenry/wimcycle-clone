<?php

class Kategori
{
    public function index($params)
    {

        $category_slug = self::bind($params);

        // Jika kategori tidak ada, redirect ke homepage
        if (!$category_slug) {
            header('Location: '. Routes::base('beranda'));
            exit;
        }

        $record = CategoryModel::getBySlug($category_slug);
        $id_category = $record['id'];

        // Data yang akan dikirimkan ke view
        $data = [
            'title' => 'Homepage',
            'description' => 'Category Page!',
            'products' => ProductModel::getAllByCategory($id_category)
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/produk/index', $data, 'home/layouts/app');
    }


    public static function bind($params)
    {
        $post = $params[0] ?? null;
        return $post;
    }
}

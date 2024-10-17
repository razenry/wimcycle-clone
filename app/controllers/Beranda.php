<?php


class Beranda
{
    public function index()
    {
        // Data yang akan dikirimkan ke view
        $data = [
            'title' => 'Homepage',
            'description' => 'Category Page!',
            'categories' => CategoryModel::all()
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/index', $data, 'home/layouts/app');
    }

    public function about()
    {
        // Data yang akan dikirimkan ke view
        $data = [
            'title' => 'About',
            'description' => 'Category Page!',
            'categories' => CategoryModel::all()
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/about', $data, 'home/layouts/app');
    }

    public function detail($params)
    {
        if (isset($params[0])) {
            $slug = $params[0];
        } else {
            header('Location: ' . Routes::base('beranda'));
            exit();
        }

        $data = [
            'title' => 'Detail',
            'description' => 'Category Page!',
            'category' => CategoryModel::getBySlug($slug)
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('home/detail', $data, 'home/layouts/app');
    }

}

<?php

class Test
{
    public function index()
    {
        // Data yang akan dikirimkan ke view
        $data = [
            'title' => 'Category',
            'description' => 'Category Page!',
            'categories' => CategoryModel::all()
        ];

        // Render view 'home/index' dengan layout 'layouts/main'
        App::view('test/layout/index', $data, 'test/layout/layout');
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
        App::view('test/about/index', $data, 'test/layout');
    }
}

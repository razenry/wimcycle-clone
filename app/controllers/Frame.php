<?php

class Frame
{

    public function index()
    {
        Session::checkSession("Admin");

        $_SESSION['gagal'] = "Access denied.";

        header("Location: " . Routes::base('admin/frame'));
        exit();
    }

    public function form($params = null)
    {
        Session::checkSession("Admin");

        if ($params != null && in_array($params[0], ['add', 'update'])) {
            $action = $params[0];
            $frame = '';

            if ($action == 'update') {
                $slug = $params[1];
                $frame = FrameModel::getBySlug($slug);
            }

            $data = [
                'title'      => "Form $action frame",
                'link'       => 'Form',
                'frame'   => $frame,
                'input'      => $_SESSION['form_data'] ?? ''
            ];

            App::view("admin/frame/actions/$action", $data, 'admin/layouts/app');
        } else {
            $_SESSION['gagal'] = "Invalid action.";
            header("Location: " . Routes::base('admin/frame'));
            exit();
        }
    }

    public function test()
    {

        $data = FrameApi::get(API_KEY);

        var_dump($data);
    }



    // Store

    public function add()
    {
        Session::checkSession("Admin");

        die(var_dump($_POST));

    }
}

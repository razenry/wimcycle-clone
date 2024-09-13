<?php

class NotFound
{
    public function index($params = null)
    {

        if ($params == null) {
            header('Location:' . Routes::base('beranda'));
        }

        foreach ($params as $key => $value) {
            $data['message'][$key] = $value;
        }

        $message = "";

        if (isset($data['message'])) {
            $message = $data['message'][0];
        }

        $data['message'] = $message;

        App::view("test/index", $data);

    }
}

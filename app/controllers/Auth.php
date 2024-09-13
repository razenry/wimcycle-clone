<?php

class Auth
{
    public function index()
    {
        App::view("admin/auth/layouts/header");
        App::view("admin/auth/login");
        App::view("admin/auth/layouts/footer");
    }    

    public function login()
    {
        var_dump($_POST);
    }

}

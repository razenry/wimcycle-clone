<?php

class Admin
{
    public function index()
    {
        App::view("admin/layouts/header");
        App::view("admin/layouts/navbar");
        App::view("admin/layouts/page-header");
        App::view("admin/index");
        App::view("admin/layouts/page-footer");
        App::view("admin/layouts/modal");
        App::view("admin/layouts/footer");
    }
}

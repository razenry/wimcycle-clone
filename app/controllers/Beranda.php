<?php

class Beranda
{
    public function index()
    {
        App::view("home/layouts/header");
        App::view("home/layouts/navbar");
        App::view("home/index");
        App::view("home/layouts/footer");
        App::view("home/layouts/script");
    }    
}

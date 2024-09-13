<?php

class Routes
{
    // Mendefinisikan konstanta database sebagai public static untuk akses mudah
    public static $DB_HOST = 'localhost';
    public static $DB_USER = 'root';
    public static $DB_PASS = '';
    public static $DB_NAME = 'db_lomba';

    public static function base($path = '')
    {
        $host = "http://localhost/wimcycle-clone/";
        $baseUrl = rtrim($host, '/') . '/' . ltrim($path, '/');
        return $baseUrl;
    }

    public static function baseImageUrl($path = '')
    {
        // Pastikan ini sesuai dengan struktur direktori Anda
        $host = 'public/storage/images/';
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }

    public static function storage($path = '')
    {
        // Pastikan ini sesuai dengan struktur direktori Anda
        $host = self::base('public/storage/images/');
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }
    public static function assets($path = '')
    {
        // Pastikan ini sesuai dengan struktur direktori Anda
        $host = "http://localhost/wimcycle-clone/public/assets/";
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }

    public static function public($url = NULL)
    {
        $base_url = 'http://localhost/wimcycle-clone/public/';
        if ($url != null) {
            return rtrim($base_url, '/') . '/' . ltrim($url, '/');
        } else {
            return $base_url;
        }
    }

    public static function views($url = NULL)
    {
        $base_url = 'http://localhost/wimcycle-clone/app/views/';
        if ($url != null) {
            return rtrim($base_url, '/') . '/' . ltrim($url, '/') . ".php";
        } else {
            return $base_url;
        }
    }
}

// // Contoh penggunaan
// echo AppHelper::routes('beranda'); // http://localhost/wimcycle-clone/beranda
// echo AppHelper::baseImageUrl('logo.png'); // http://localhost/wimcycle-clone/storage/images/logo.png

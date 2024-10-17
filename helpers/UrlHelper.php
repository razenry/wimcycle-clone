<?php

class UrlHelper
{
    public static function getCurrentFolderUrl()
    {
        // Ambil protokol (http atau https)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

        // Ambil nama domain
        $domain = $_SERVER['HTTP_HOST'];

        // Ambil path direktori saat ini
        $currentDir = dirname($_SERVER['SCRIPT_NAME']); // Mengambil direktori skrip saat ini

        // Gabungkan semua untuk mendapatkan URL penuh
        return $protocol . $domain . $currentDir;
    }

    public static function getUrl()
    {
        return "http://wimcycle-clone.test/";
    }

}


<?php

// Class that provides various utility methods for constructing URLs and file paths.
class Routes
{

    // Returns the base URL concatenated with the provided path.
    public static function base($path = '')
    {
        $host = UrlHelper::getCurrentFolderUrl();
        $baseUrl = rtrim($host, '/') . '' . ltrim($path, '/');
        return $baseUrl;
    }

    // Returns the upload path for images concatenated with the provided path.
    public static function upload($path = '')
    {
        $host = 'storage/images/';
        return $host. ltrim($path, '/');
    }

    public static function baseImage($path = '')
    {
        $host = self::base('storage/images/');
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }

    // Returns the storage path for images based on the base URL.
    public static function storage($path = '')
    {
        return self::baseImage($path); // Menggunakan self::upload untuk konsistensi
    }

    // Returns the assets path concatenated with the provided path.
    public static function assets($path = '')
    {
        $host = self::base('public/assets/');
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }

    // Returns the public URL. If a URL is provided, it appends it to the base public URL.
    public static function public($url = NULL)
    {
        $base_url = self::base('public/'); // Menggunakan self::base untuk mendapatkan URL dasar
        if ($url != null) {
            return rtrim($base_url, '/') . '/' . ltrim($url, '/');
        } else {
            return $base_url;
        }
    }

    // Returns the views directory path. If a URL is provided, it appends it to the base views URL with a .php extension.
    public static function views($url = NULL)
    {
        $base_url = self::base('app/views/'); // Menggunakan self::base untuk mendapatkan URL dasar
        if ($url != null) {
            return rtrim($base_url, '/') . '/' . ltrim($url, '/') . ".php";
        } else {
            return $base_url;
        }
    }
}

<?php
 
// Class that provides various utility methods for constructing URLs and file paths.
class Routes
{
    public static $DB_HOST = 'localhost';
    public static $DB_USER = 'root';
    public static $DB_PASS = '';
    public static $DB_NAME = 'db_lomba';
 
    // Returns the base URL concatenated with the provided path.
    public static function base($path = '')
    {
        $host = "http://localhost/wimcycle-clone/";
        $baseUrl = rtrim($host, '/') . '/' . ltrim($path, '/');
        return $baseUrl;
    }
 
    // Returns the upload path for images concatenated with the provided path.
    public static function upload($path = '')
    {
        $host = 'storage/images/';
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }
 
    // Returns the storage path for images based on the base URL.
    public static function storage($path = '')
    {
        $host = self::base('storage/images/');
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }
 
    // Returns the assets path concatenated with the provided path.
    public static function assets($path = '')
    {
        $host = "http://localhost/wimcycle-clone/public/assets/";
        return rtrim($host, '/') . '/' . ltrim($path, '/');
    }
 
    // Returns the public URL. If a URL is provided, it appends it to the base public URL.
    public static function public($url = NULL)
    {
        $base_url = 'http://localhost/wimcycle-clone/public/';
        if ($url != null) {
            return rtrim($base_url, '/') . '/' . ltrim($url, '/');
        } else {
            return $base_url;
        }
    }
 
    // Returns the views directory path. If a URL is provided, it appends it to the base views URL with a .php extension.
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
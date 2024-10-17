<?php

class SlideModel extends Database
{
    private static $table = "slides";
    
    private static $db;

    public static function init()
    {
        // Membuat instance database secara static
        self::$db = new Database();
    }

    /**
     * Fetch all categories from the database (static method)
     * @return array
     */
    public static function all()
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil semua kategori
        self::$db->query("SELECT * FROM " . self::$table);
        // Mengembalikan hasil sebagai array asosiatif
        return self::$db->resultSet();
    }

    public static function getBySlug($slug)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil kategori berdasarkan slug
        self::$db->query("SELECT * FROM " . self::$table . " WHERE slug = :slug");
        self::$db->bind(':slug', $slug);

        // Mengembalikan satu baris hasil atau null jika tidak ditemukan
        return self::$db->single();
    }

    public static function updateStatus($slug, $status)
    {

        if (!self::$db) {
            self::init();
        }

        self::$db->query("UPDATE ". self::$table ." SET status = :status WHERE slug = :slug");
        self::$db->bind(':slug', $slug);
        self::$db->bind(':status', $status);
        return self::$db->execute();
    }

}

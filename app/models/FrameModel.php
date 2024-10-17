<?php 

// namespace App\FrameModel;
/**
 * Undefined class
 */
class FrameModel extends Database
{
    private static $table = 'frames';

    private static $db;
    
    public static function init()
    {
        return self::$db = new Database();
    }

    public static function all()
    {
        if (!self::$db) {
            self::init();
        }

        self::$db->query("SELECT * FROM ".self::$table);
        self::$db->execute();
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

}

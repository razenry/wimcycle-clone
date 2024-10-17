<?php

class UserModel extends Database
{
    private static $table = 'users';
    private static $db;

    // Inisialisasi database secara static
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

    public static function getById($id)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil kategori berdasarkan id
        self::$db->query("SELECT * FROM " . self::$table . " WHERE id = :id");
        self::$db->bind(':id', $id);

        // Mengembalikan satu baris hasil atau null jika tidak ditemukan
        return self::$db->single();
    }

    public static function getByEmail($email)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil kategori berdasarkan email
        self::$db->query("SELECT * FROM " . self::$table . " WHERE email = :email");
        self::$db->bind(':email', $email);

        // Mengembalikan satu baris hasil atau null jika tidak ditemukan
        return self::$db->single();
    }
}

<?php

class CategoryModel extends Database
{
    private static $table = 'categories';
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

    public static function getActive()
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil semua kategori
        self::$db->query("SELECT * FROM " . self::$table . " WHERE status = 1");
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

    public static function getAllBySlug($slug)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil kategori berdasarkan slug
        self::$db->query("SELECT * FROM " . self::$table . " WHERE slug = :slug");
        self::$db->bind(':slug', $slug);

        // Mengembalikan satu baris hasil atau null jika tidak ditemukan
        return self::$db->resultSet();
    }

    public static function generateSlug($name)
    {
        $slug = strtolower($name); // Konversi ke huruf kecil
        $slug = str_replace(' ', '-', $slug); // Ganti spasi dengan tanda hubung
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug); // Hapus karakter non-alphanumerik
        $slug = trim($slug, '-'); // Hapus tanda hubung dari awal dan akhir
        return $slug;
    }

    public static function exists($name)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        Self::$db->query("SELECT COUNT(*) AS count FROM " . Self::$table . " WHERE name = :name");
        Self::$db->bind(':name', $name);
        $result = Self::$db->single(); // Mengambil satu hasil
        return $result['count'] > 0; // Mengembalikan true jika ada kategori dengan nama tersebut
    }

    public static function updateStatus($slug, $status)
    {

        if (!self::$db) {
            self::init();
        }

        self::$db->query("UPDATE " . self::$table . " SET status = :status WHERE slug = :slug");
        self::$db->bind(':slug', $slug);
        self::$db->bind(':status', $status);
        return self::$db->execute();
    }

    public static function insert($data)
    {

        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        self::$db->query("INSERT INTO " . self::$table . " (id_user, slug, name, description, photo, status, created_at) VALUES (:id_user, :slug, :name, :description , :photo, :status, :created_at)");
        self::$db->bind(':id_user', $data['id_user']);
        self::$db->bind(':slug', $data['slug']);
        self::$db->bind(':name', $data['name']);
        self::$db->bind(':description', $data['description']);
        self::$db->bind(':photo', $data['photo']);
        self::$db->bind(':status', 1);
        self::$db->bind(':created_at', date('Y-m-d H:i:s'));
        return self::$db->execute();
    }

    public static function update($data, $slug)
    {
        if (!self::$db) {
            self::init();
        }

        // Prepare SQL query for updating the category
        self::$db->query("UPDATE " . self::$table . " SET name = :name, slug = :slug, description = :description, photo = :photo, updated_at = :updated_at WHERE slug = :target");
        self::$db->bind(':name', $data['name']);
        self::$db->bind(':slug', $data['slug']);
        self::$db->bind(':description', $data['description']);
        self::$db->bind(':photo', $data['photo']);
        self::$db->bind(':updated_at', date('Y-m-d H:i:s'));
        self::$db->bind(':target', $slug);

        return self::$db->execute();
    }

    public static function delete($slug)
    {
        if (!self::$db) {
            self::init();
        }

        // Prepare SQL query for deleting the category
        self::$db->query("DELETE FROM " . self::$table . " WHERE slug = :slug");
        self::$db->bind(':slug', $slug);

        return self::$db->execute();
    }
}

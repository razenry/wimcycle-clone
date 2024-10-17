<?php

class ProductModel extends Database
{
    private static $table = 'product';
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

        // Query untuk mengambil semua data dari tabel product, beserta kategori, frame, dan user terkait
        $sql = "
            SELECT 
                p.id AS product_id, 
                p.slug AS product_slug, 
                p.name AS product_name, 
                p.price AS product_price, 
                p.photo AS product_photo, 
                p.description AS product_description, 
                p.status AS product_status, 
                p.created_at AS product_created_at, 
                p.updated_at AS product_updated_at,
                
                c.id AS category_id, 
                c.name AS category_name, 
                c.description AS category_description,
                
                f.id AS frame_id, 
                f.name AS frame_name, 
                -- f.material AS frame_material,  // Uncomment if frame has 'material' column
                
                u.id AS user_id, 
                u.name AS user_name, 
                u.email AS user_email
                
            FROM " . self::$table . " p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN frames f ON p.frame_id = f.id
            LEFT JOIN users u ON p.id_user = u.id
        ";

        // Eksekusi query
        self::$db->query($sql);

        // Mendapatkan hasil query
        $results = self::$db->resultSet();

        // Mengorganisir data ke dalam struktur array yang diinginkan
        $products = [];
        foreach ($results as $row) {
            // Memasukkan data produk
            $products[] = [
                "product" => [
                    "id" => $row['product_id'],
                    "slug" => $row['product_slug'],
                    "name" => $row['product_name'],
                    "price" => $row['product_price'],
                    "description" => $row['product_description'],
                    "photo" => $row['product_photo'],
                    "status" => $row['product_status'],
                    "created_at" => $row['product_created_at'],
                    "updated_at" => $row['product_updated_at'],
                    "user" => [
                        "id" => $row['user_id'],
                        "name" => $row['user_name'],
                        "email" => $row['user_email']
                    ],
                    // Memasukkan data frame terkait
                    "frame" => [
                        "id" => $row['frame_id'],
                        "name" => $row['frame_name'],  // Nama frame
                        // "material" => $row['frame_material']  // Jika ada kolom material pada frame
                    ],
                    // Memasukkan data kategori terkait
                    "category" => [
                        "id" => $row['category_id'],
                        "name" => $row['category_name'],  // Nama kategori
                        "description" => $row['category_description']  // Deskripsi kategori
                    ]
                ]
            ];
        }

        // Mengembalikan array yang telah diorganisir
        return $products;
    }

    public static function getAllByCategory($id_category)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil semua data dari tabel product, beserta kategori, frame, dan user terkait
        $sql = "
            SELECT 
                p.id AS product_id, 
                p.slug AS product_slug, 
                p.name AS product_name, 
                p.price AS product_price, 
                p.photo AS product_photo, 
                p.description AS product_description, 
                p.status AS product_status, 
                p.created_at AS product_created_at, 
                p.updated_at AS product_updated_at,
                
                c.id AS category_id, 
                c.name AS category_name, 
                c.description AS category_description,
                
                f.id AS frame_id, 
                f.name AS frame_name, 
                -- f.material AS frame_material,  // Uncomment if frame has 'material' column
                
                u.id AS user_id, 
                u.name AS user_name, 
                u.email AS user_email
                
            FROM " . self::$table . " p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN frames f ON p.frame_id = f.id
            LEFT JOIN users u ON p.id_user = u.id
            WHERE p.category_id = :category_id
        ";

        // Eksekusi query
        self::$db->query($sql);
        self::$db->bind(':category_id', $id_category);

        // Mendapatkan hasil query
        $results = self::$db->resultSet();

        // Mengorganisir data ke dalam struktur array yang diinginkan
        $products = [];
        foreach ($results as $row) {
            // Memasukkan data produk
            $products[] = [
                "product" => [
                    "id" => $row['product_id'],
                    "slug" => $row['product_slug'],
                    "name" => $row['product_name'],
                    "price" => $row['product_price'],
                    "description" => $row['product_description'],
                    "photo" => $row['product_photo'],
                    "status" => $row['product_status'],
                    "created_at" => $row['product_created_at'],
                    "updated_at" => $row['product_updated_at'],
                    "user" => [
                        "id" => $row['user_id'],
                        "name" => $row['user_name'],
                        "email" => $row['user_email']
                    ],
                    // Memasukkan data frame terkait
                    "frame" => [
                        "id" => $row['frame_id'],
                        "name" => $row['frame_name'],  // Nama frame
                        // "material" => $row['frame_material']  // Jika ada kolom material pada frame
                    ],
                    // Memasukkan data kategori terkait
                    "category" => [
                        "id" => $row['category_id'],
                        "name" => $row['category_name'],  // Nama kategori
                        "description" => $row['category_description']  // Deskripsi kategori
                    ]
                ]
            ];
        }

        // Mengembalikan array yang telah diorganisir
        return $products;
    }

    public static function getBySlug($slug)
    {
        // Inisialisasi database jika belum dilakukan
        if (!self::$db) {
            self::init();
        }

        // Query untuk mengambil kategori berdasarkan slug
        self::$db->query("SELECT 
        p.id AS product_id, 
        p.slug AS product_slug, 
        p.name AS product_name, 
        p.price AS product_price, 
        p.photo AS product_photo, 
        p.description AS product_description, 
        p.status AS product_status, 
        p.created_at AS product_created_at, 
        p.updated_at AS product_updated_at,
        
        c.id AS category_id, 
        c.name AS category_name, 
        c.description AS category_description,
        
        f.id AS frame_id, 
        f.name AS frame_name, 
        f.description AS frame_description, 
        -- f.material AS frame_material,  // Uncomment if frame has 'material' column
        
        u.id AS user_id, 
        u.name AS user_name, 
        u.email AS user_email
        
    FROM " . self::$table . " p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN frames f ON p.frame_id = f.id
    LEFT JOIN users u ON p.id_user = u.id 
    WHERE p.slug = :slug"); // Perhatikan di sini, saya menambahkan 'p.' sebelum slug

        self::$db->bind(':slug', $slug);

        // Mengembalikan satu baris hasil atau null jika tidak ditemukan
        return self::$db->single();
    }

    public static function getRelatedProduct($slug, $product_slug)
    {
        // Initialize database if it hasn't been done
        if (!self::$db) {
            self::init();
        }

        // Query to fetch related products by category, excluding the current product by its slug
        self::$db->query("SELECT 
        p.id AS product_id, 
        p.slug AS product_slug, 
        p.name AS product_name, 
        p.price AS product_price, 
        p.photo AS product_photo, 
        p.description AS product_description, 
        p.status AS product_status, 
        p.created_at AS product_created_at, 
        p.updated_at AS product_updated_at,
        
        c.id AS category_id, 
        c.name AS category_name, 
        c.description AS category_description,
        
        f.id AS frame_id, 
        f.name AS frame_name, 
        f.description AS frame_description, 
        
        u.id AS user_id, 
        u.name AS user_name, 
        u.email AS user_email
        
    FROM " . self::$table . " p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN frames f ON p.frame_id = f.id
    LEFT JOIN users u ON p.id_user = u.id 
    WHERE c.slug = :slug 
    AND p.slug != :product_slug");  // Exclude the product with $product_slug

        // Bind the parameters
        self::$db->bind(':slug', $slug);
        self::$db->bind(':product_slug', $product_slug);

        // Return the result set, or null if not found
        return self::$db->resultSet();
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

        self::$db->query("INSERT INTO " . self::$table . " (id_user, slug, name, description, price, photo, frame_id, category_id, status, created_at, updated_at) VALUES (:id_user, :slug, :name, :description , :price , :photo, :frame, :category, :status, :created_at, :updated_at)");
        self::$db->bind(':id_user', $data['id_user']);
        self::$db->bind(':name', $data['name']);
        self::$db->bind(':slug', $data['slug']);
        self::$db->bind(':description', $data['description']);
        self::$db->bind(':price', $data['price']);
        self::$db->bind(':photo', $data['photo']);
        self::$db->bind(':frame', $data['frame']);
        self::$db->bind(':category', $data['category']);
        self::$db->bind(':status', 1);
        self::$db->bind(':created_at', date('Y-m-d H:i:s'));
        self::$db->bind(':updated_at', date('Y-m-d H:i:s'));
        return self::$db->execute();
    }

    public static function update($data, $slug)
    {
        if (!self::$db) {
            self::init();
        }

        // Prepare SQL query for updating the category
        self::$db->query("UPDATE " . self::$table . " SET id_user = :id_user, name = :name, slug = :slug, description = :description, price = :price, photo = :photo, frame_id = :frame, category_id = :category, updated_at = :updated_at WHERE slug = :target");

        // Bind parameters
        self::$db->bind(':id_user', $data['id_user']);
        self::$db->bind(':name', $data['name']);
        self::$db->bind(':slug', $data['slug']);
        self::$db->bind(':description', $data['description']);
        self::$db->bind(':price', $data['price']);
        self::$db->bind(':photo', $data['photo']);
        self::$db->bind(':frame', $data['frame']);
        self::$db->bind(':category', $data['category']);
        self::$db->bind(':updated_at', date('Y-m-d H:i:s'));
        self::$db->bind(':target', $slug);  // Bind :target to the original slug

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

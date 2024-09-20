<?php

class Category_model extends Database
{
    private $table = "categories"; // Tabel utama untuk kategori

    public function __construct()
    {
        parent::__construct(); // Memanggil constructor dari kelas Database
    }

    // Mengambil semua kategori
    public function getAll()
    {
        $this->query("SELECT * FROM {$this->table}");
        return $this->resultSet(); // Mengembalikan array semua data kategori
    }

    // Mengambil kategori berdasarkan ID
    public function getById($id)
    {
        $this->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single(); // Mengembalikan data kategori dengan ID tertentu
    }

    // Mengambil kategori berdasarkan slug
    public function getBySlug($slug)
    {
        $this->query("SELECT * FROM {$this->table} WHERE slug = :slug");
        $this->bind(':slug', $slug);
        return $this->single(); // Mengembalikan data kategori berdasarkan slug
    }

    // Menambahkan kategori baru
    public function insert($data)
    {
        $this->query("INSERT INTO {$this->table} (id_user, slug, name, description, photo, status, created_at) VALUES (:id_user, :slug, :name, :description , :photo, :status, :created_at)");
        $this->bind(':id_user', $data['id_user']);
        $this->bind(':slug', $data['slug']);
        $this->bind(':name', $data['name']);
        $this->bind(':description', $data['description']);
        $this->bind(':photo', $data['photo']);
        $this->bind(':status', 1);
        $this->bind(':created_at', date('Y-m-d H:i:s'));
        return $this->execute(); // Menjalankan query dan mengembalikan true/false
    }

    // Mengecek apakah kategori dengan nama tertentu sudah ada
    public function exists($name)
    {
        $this->query("SELECT COUNT(*) AS count FROM {$this->table} WHERE name = :name");
        $this->bind(':name', $name);
        $result = $this->single(); // Mengambil satu hasil
        return $result['count'] > 0; // Mengembalikan true jika ada kategori dengan nama tersebut
    }

    // Generate slug dari nama kategori
    public function generateSlug($name)
    {
        $slug = strtolower($name); // Konversi ke huruf kecil
        $slug = str_replace(' ', '-', $slug); // Ganti spasi dengan tanda hubung
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug); // Hapus karakter non-alphanumerik
        $slug = trim($slug, '-'); // Hapus tanda hubung dari awal dan akhir
        return $slug;
    }

    // Menghapus kategori berdasarkan ID
    public function deleteById($id)
    {
        $this->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute(); // Menjalankan query dan mengembalikan true/false
    }

    // Menghapus kategori berdasarkan slug
    public function deleteBySlug($slug)
    {
        $this->query("DELETE FROM {$this->table} WHERE slug = :slug");
        $this->bind(':slug', $slug);
        return $this->execute();
    }

    // Memperbarui status kategori berdasarkan slug
    public function updateStatus($slug, $status)
    {
        $this->query("UPDATE {$this->table} SET status = :status WHERE slug = :slug");
        $this->bind(':slug', $slug);
        $this->bind(':status', $status);
        return $this->execute();
    }

    // Memperbarui kategori (selain photo)
    public function update($slug, $data)
    {
        $this->query("UPDATE {$this->table} SET name = :name, photo = :photo, description = :description WHERE slug = :slug");
        $this->bind(':slug', $slug);
        $this->bind(':name', $data['name']);
        $this->bind(':photo',  $data['photo']);
        $this->bind(':description', $data['description']);
        return $this->execute();
    }
    // Menghitung jumlah kategori
    public function getCategoryCount()
    {
        $this->query("SELECT COUNT(*) AS count FROM {$this->table}");
        $result = $this->single(); // Mengambil satu hasil
        return $result['count']; // Mengembalikan jumlah kategori
    }
}

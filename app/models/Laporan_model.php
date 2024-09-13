<?php

class Laporan_model extends Database
{
    private $table = "laporan";
    private $foto_table = "foto";  // New variable for the 'foto' table

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        ORDER BY 
            l.tgl_laporan DESC, l.jam_lapor DESC
    ");
        $results = $this->resultSet();

        // Organize data into an array with 'pengguna' key
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Optionally, remove individual pengguna columns
            unset($row['pengguna_id']);
            unset($row['pengguna_nama']);
            unset($row['pengguna_foto']);
            unset($row['pengguna_email']);
            unset($row['pengguna_telp']);
            unset($row['pengguna_status']);
        }

        return $results;
    }


    public function getDataByUserId($user_id)
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        WHERE 
            l.id_pengguna = :id_pengguna
        ORDER BY 
            l.tgl_laporan DESC, l.jam_lapor DESC
    ");
        $this->bind(':id_pengguna', $user_id);
        $results = $this->resultSet();

        // Organize data into an array with 'pengguna' key
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Optionally, remove individual pengguna columns
            unset($row['pengguna_id']);
            unset($row['pengguna_nama']);
            unset($row['pengguna_foto']);
            unset($row['pengguna_email']);
            unset($row['pengguna_telp']);
            unset($row['pengguna_status']);
        }

        return $results;
    }



    public function getById($id)
    {
        $this->query("
            SELECT 
                l.*, 
                p.id AS pengguna_id,
                p.nama AS pengguna_nama,
                p.foto AS pengguna_foto,
                p.email AS pengguna_email,
                p.telp AS pengguna_telp,
                p.status AS pengguna_status
            FROM 
                $this->table l
            JOIN 
                pengguna p 
            ON 
                l.id_pengguna = p.id
            WHERE 
                l.id = :id
        ");
        $this->bind(':id', $id);
        $result = $this->single();

        // Organize data into an array with 'pengguna' key
        if ($result) {
            $result['pengguna'] = [
                'id' => $result['pengguna_id'],
                'nama' => $result['pengguna_nama'],
                'foto' => $result['pengguna_foto'],
                'email' => $result['pengguna_email'],
                'telp' => $result['pengguna_telp'],
                'status' => $result['pengguna_status']
            ];

            // Fetch associated photos
            $result['fotos'] = $this->getFotosByLaporanId($result['id']);

            // Optionally, remove individual pengguna columns
            unset($result['pengguna_id']);
            unset($result['pengguna_nama']);
            unset($result['pengguna_foto']);
            unset($result['pengguna_email']);
            unset($result['pengguna_telp']);
            unset($result['pengguna_status']);
        }

        return $result;
    }

    public function generateUniqueSlug($prefix = 'TGSL')
    {
        do {
            // Generate a random number between 10000 and 99999
            $randomNumber = mt_rand(10000, 99999);

            // Create the slug by combining the prefix and the random number
            $slug = $prefix . $randomNumber;

            // Check if this slug already exists in the database
            $this->query("SELECT COUNT(*) as count FROM $this->table WHERE slug = :slug");
            $this->bind(':slug', $slug);
            $result = $this->single();
        } while ($result['count'] > 0); // Repeat if the slug is not unique

        return $slug;
    }

    public function addData($data)
    {
        $this->query("
            INSERT INTO $this->table (
                slug, 
                id_pengguna, 
                judul, 
                isi_laporan, 
                tgl_laporan, 
                jam_lapor, 
                jenis_laporan, 
                status, 
                kecamatan, 
                kelurahan
            ) VALUES (
                :slug, 
                :id_pengguna, 
                :judul, 
                :isi_laporan, 
                :tgl_laporan, 
                :jam_lapor, 
                :jenis_laporan, 
                :status, 
                :kecamatan, 
                :kelurahan
            )
        ");

        $this->bind(':slug', $data['slug']);
        $this->bind(':id_pengguna', $data['id_pengguna']);
        $this->bind(':judul', $data['judul']);
        $this->bind(':isi_laporan', $data['isi_laporan']);
        $this->bind(':tgl_laporan', $data['tgl_laporan']);
        $this->bind(':jam_lapor', $data['jam_lapor']);
        $this->bind(':jenis_laporan', $data['jenis_laporan']);
        $this->bind(':status', $data['status']);
        $this->bind(':kecamatan', $data['kecamatan']);
        $this->bind(':kelurahan', $data['kelurahan']);

        if ($this->execute()) {
            // Get the last inserted laporan ID
            $laporan_id = $this->lastInsertId();

            // Insert associated photos
            if (isset($data['fotos'])) {
                foreach ($data['fotos'] as $foto) {
                    $this->addFoto($laporan_id, $foto);
                }
            }

            return true;
        }

        return false;
    }

    public function updateData($id, $data)
    {
        $this->query("
            UPDATE $this->table 
            SET 
                id_pengguna = :id_pengguna, 
                isi_laporan = :isi_laporan, 
                tgl_laporan = :tgl_laporan, 
                jam_lapor = :jam_lapor, 
                jenis_laporan = :jenis_laporan, 
                status = :status, 
                kecamatan = :kecamatan, 
                kelurahan = :kelurahan 
            WHERE 
                id = :id
        ");

        $this->bind(':id_pengguna', $data['id_pengguna']);
        $this->bind(':isi_laporan', $data['isi_laporan']);
        $this->bind(':tgl_laporan', $data['tgl_laporan']);
        $this->bind(':jam_lapor', $data['jam_lapor']);
        $this->bind(':jenis_laporan', $data['jenis_laporan']);
        $this->bind(':status', $data['status']);
        $this->bind(':kecamatan', $data['kecamatan']);
        $this->bind(':kelurahan', $data['kelurahan']);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Update associated photos
            if (isset($data['fotos'])) {
                // First, delete existing photos for the laporan
                $this->deleteFotosByLaporanId($id);

                // Then, add the new photos
                foreach ($data['fotos'] as $foto) {
                    $this->addFoto($id, $foto);
                }
            }

            return true;
        }

        return false;
    }

    public function deleteData($id)
    {
        // Delete associated photos first
        $this->deleteFotosByLaporanId($id);

        $this->query("DELETE FROM $this->table WHERE id = :id");
        $this->bind(':id', $id);

        return $this->execute();
    }

    public function updateStatus($id, $status)
    {
        $this->query("UPDATE $this->table SET status = :status WHERE id = :id");
        $this->bind(':status', $status);
        $this->bind(':id', $id);

        return $this->execute();
    }

    // New methods for managing photos
    public function getFotosByLaporanId($laporan_id)
    {
        $this->query("SELECT * FROM $this->foto_table WHERE id_laporan = :id_laporan");
        $this->bind(':id_laporan', $laporan_id);
        return $this->resultSet();
    }

    public function addFoto($laporan_id, $foto)
    {
        $this->query("
            INSERT INTO $this->foto_table (id_laporan, foto) 
            VALUES (:id_laporan, :foto)
        ");
        $this->bind(':id_laporan', $laporan_id);
        $this->bind(':foto', $foto);
        $this->execute();
    }

    public function deleteFotosByLaporanId($laporan_id)
    {
        $this->query("DELETE FROM $this->foto_table WHERE id_laporan = :id_laporan");
        $this->bind(':id_laporan', $laporan_id);
        $this->execute();
    }

    public function getDataByStatus($status)
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        WHERE 
            l.status = :status
            AND l.jenis_laporan != 'Rahasia'
        ORDER BY 
            l.jam_lapor DESC
    ");

        $this->bind(':status', $status);
        $results = $this->resultSet();

        // Organize data into an array with 'pengguna' key
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Optionally, remove individual pengguna columns
            unset($row['pengguna_id']);
            unset($row['pengguna_nama']);
            unset($row['pengguna_foto']);
            unset($row['pengguna_email']);
            unset($row['pengguna_telp']);
            unset($row['pengguna_status']);
        }

        return $results;
    }

    public function getDataBySlug($slug)
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        WHERE 
            l.slug = :slug 
    ");
        $this->bind(':slug', $slug);
        $result = $this->single();

        // Organize data into an array with 'pengguna' key
        if ($result) {
            $result['pengguna'] = [
                'id' => $result['pengguna_id'],
                'nama' => $result['pengguna_nama'],
                'foto' => $result['pengguna_foto'],
                'email' => $result['pengguna_email'],
                'telp' => $result['pengguna_telp'],
                'status' => $result['pengguna_status']
            ];

            // Fetch associated photos
            $result['fotos'] = $this->getFotosByLaporanId($result['id']);

            // Optionally, remove individual pengguna columns
            unset($result['pengguna_id']);
            unset($result['pengguna_nama']);
            unset($result['pengguna_foto']);
            unset($result['pengguna_email']);
            unset($result['pengguna_telp']);
            unset($result['pengguna_status']);
        }

        return $result;
    }

    public function countLaporanByStatus($key)
    {
        // Prepare the SQL query
        $this->query("SELECT COUNT(*) AS total FROM laporan WHERE status = :key");

        // Bind the value of $key to the :key placeholder
        $this->bind(":key", $key);

        // Return the result of the query
        return $this->single();
    }
    public function countLaporan()
    {
        // Prepare the SQL query
        $this->query("SELECT COUNT(*) AS total FROM laporan");

        // Return the result of the query
        return $this->single();
    }


    public function cariLaporan($key, $idPengguna)
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        WHERE 
            l.judul LIKE :judul
            AND l.id_pengguna = :id_pengguna
        ORDER BY 
            l.tgl_laporan DESC, l.jam_lapor DESC
    ");

        // Bind parameters
        $this->bind(':judul', '%' . $key . '%');
        $this->bind(':id_pengguna', $idPengguna);

        // Execute query and fetch results
        $results = $this->resultSet();

        // Process results
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Remove individual columns if needed
            unset($row['pengguna_id'], $row['pengguna_nama'], $row['pengguna_foto'], $row['pengguna_email'], $row['pengguna_telp'], $row['pengguna_status']);
        }

        return $results;
    }

    public function cariSemuaLaporan($key)
    {
        $this->query("
        SELECT 
            l.*, 
            p.id AS pengguna_id,
            p.nama AS pengguna_nama,
            p.foto AS pengguna_foto,
            p.email AS pengguna_email,
            p.telp AS pengguna_telp,
            p.status AS pengguna_status
        FROM 
            $this->table l
        JOIN 
            pengguna p 
        ON 
            l.id_pengguna = p.id
        WHERE 
            l.judul LIKE :judul
            AND l.status = 'Tuntas'
            AND l.jenis_laporan != 'Rahasia'
        ORDER BY 
            l.tgl_laporan DESC, l.jam_lapor DESC
        ");


        // Bind parameters
        $this->bind(':judul', '%' . $key . '%');

        // Execute query and fetch results
        $results = $this->resultSet();

        // Process results
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Remove individual columns if needed
            unset($row['pengguna_id'], $row['pengguna_nama'], $row['pengguna_foto'], $row['pengguna_email'], $row['pengguna_telp'], $row['pengguna_status']);
        }

        return $results;
    }


    public function setJenisLaporan($slug, $idPengguna, $jenis_laporan)
    {
        $this->query("
            UPDATE $this->table 
            SET jenis_laporan = :jenis_laporan 
            WHERE slug = :slug AND id_pengguna = :id_pengguna
        ");
        $this->bind(':jenis_laporan', $jenis_laporan);
        $this->bind(':slug', $slug);
        $this->bind(':id_pengguna', $idPengguna);
        return $this->execute();
    }

    public function CountStatusBy($status)
    {
        // Query untuk menghitung jumlah laporan berdasarkan status yang diberikan
        $this->query("
        SELECT COUNT(*) AS total 
        FROM $this->table 
        WHERE status = :status
    ");
        $this->bind(':status', $status);

        // Mengembalikan hasil query
        $result = $this->single();

        // Mengembalikan jumlah laporan dengan status yang diberikan
        return $result['total'];
    }

    public function CountUserReportByStatus($user_id, $status)
    {
        // Query untuk menghitung jumlah laporan berdasarkan user_id dan status yang diberikan
        $this->query("
        SELECT COUNT(*) AS total 
        FROM $this->table 
        WHERE user_id = :user_id AND status = :status
    ");
        $this->bind(':user_id', $user_id);
        $this->bind(':status', $status);

        // Mengembalikan hasil query
        $result = $this->single();

        // Mengembalikan jumlah laporan dengan user_id dan status yang diberikan
        return $result['total'];
    }

    public function getLaporanByStatus($userId, $status)
    {
        // Sanitasi input jika diperlukan
        $userId = htmlspecialchars(strip_tags($userId));
        $status = htmlspecialchars(strip_tags($status));

        // Debugging: Tampilkan status dan userId yang akan digunakan
        error_log("Debug: User ID yang digunakan dalam query: " . $userId);
        error_log("Debug: Status yang digunakan dalam query: " . $status);

        // Menjalankan query dengan filter user_id dan status
        $this->query("
    SELECT 
        l.*, 
        p.id AS pengguna_id,
        p.nama AS pengguna_nama,
        p.foto AS pengguna_foto,
        p.email AS pengguna_email,
        p.telp AS pengguna_telp,
        p.status AS pengguna_status
    FROM 
        $this->table l
    JOIN 
        pengguna p 
    ON 
        l.id_pengguna = p.id
    WHERE 
        l.id_pengguna = :userId
        AND l.status = :status
    ORDER BY 
        l.id DESC
        ");

        $this->bind(':userId', $userId);
        $this->bind(':status', $status);
        $results = $this->resultSet();

        // Debugging: Periksa hasil query
        error_log("Debug: Hasil query: " . print_r($results, true));

        // Organize data into an array with 'pengguna' key
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Optionally, remove individual pengguna columns
            unset($row['pengguna_id']);
            unset($row['pengguna_nama']);
            unset($row['pengguna_foto']);
            unset($row['pengguna_email']);
            unset($row['pengguna_telp']);
            unset($row['pengguna_status']);
        }

        return $results;
    }

    public function cariLaporanByKecamatanAndStatus($kecamatan)
    {
        $this->query("
    SELECT 
        l.*, 
        p.id AS pengguna_id,
        p.nama AS pengguna_nama,
        p.foto AS pengguna_foto,
        p.email AS pengguna_email,
        p.telp AS pengguna_telp,
        p.status AS pengguna_status
    FROM 
        $this->table l
    JOIN 
        pengguna p 
    ON 
        l.id_pengguna = p.id
    WHERE 
        l.kecamatan = :kecamatan
        AND l.status = 'Tuntas'
        AND l.jenis_laporan != 'Rahasia'
    ORDER BY 
        l.tgl_laporan DESC, l.jam_lapor DESC
    ");

        // Bind the kecamatan parameter
        $this->bind(':kecamatan', $kecamatan);

        // Execute query and fetch results
        $results = $this->resultSet();

        // Organize data into an array with 'pengguna' key and fetch associated photos
        foreach ($results as &$row) {
            $row['pengguna'] = [
                'id' => $row['pengguna_id'],
                'nama' => $row['pengguna_nama'],
                'foto' => $row['pengguna_foto'],
                'email' => $row['pengguna_email'],
                'telp' => $row['pengguna_telp'],
                'status' => $row['pengguna_status']
            ];

            // Fetch associated photos
            $row['fotos'] = $this->getFotosByLaporanId($row['id']);

            // Optionally, remove individual pengguna columns
            unset($row['pengguna_id']);
            unset($row['pengguna_nama']);
            unset($row['pengguna_foto']);
            unset($row['pengguna_email']);
            unset($row['pengguna_telp']);
            unset($row['pengguna_status']);
        }

        return $results;
    }
}

<?php

class Tanggapan_model extends Database
{
    private $table = "tanggapan"; // The main table for storing responses
    private $foto_table = "foto_tanggapan"; // Table for storing the photos related to responses

    public function __construct()
    {
        parent::__construct(); // Calls the constructor of the Database class
    }

    // Retrieve all tanggapan (responses)
    public function getAllTanggapan()
    {
        $this->query("SELECT * FROM {$this->table}");
        return $this->resultSet(); // Returns an array of all tanggapan records
    }

    // Retrieve tanggapan by laporan ID
    public function getTanggapanByIdLaporan($idLaporan)
    {
        $this->query("SELECT * FROM {$this->table} WHERE id_laporan = :id_laporan");
        $this->bind(':id_laporan', $idLaporan);
        return $this->resultSet(); // Returns all responses linked to a specific report
    }

    // Add a new tanggapan
    public function addTanggapan($data)
    {
        $this->query("INSERT INTO {$this->table} (id_laporan, id_petugas, tanggapan, status, tgl_tanggapan, jam_tanggapan) 
                      VALUES (:id_laporan, :id_petugas, :tanggapan, :status, :tgl_tanggapan, :jam_tanggapan)");

        $this->bind(':id_laporan', $data['id_laporan']);
        $this->bind(':id_petugas', $data['id_petugas']);
        $this->bind(':tanggapan', $data['tanggapan']);
        $this->bind(':status', $data['status']);
        $this->bind(':tgl_tanggapan', $data['tgl_tanggapan']);
        $this->bind(':jam_tanggapan', $data['jam_tanggapan']);

        $this->execute();
        return $this->lastInsertId(); // Returns the last inserted ID (tanggapan ID)
    }

    // Add photos for a specific tanggapan
    public function addTanggapanPhotos($tanggapanId, $photos)
    {
        foreach ($photos as $photo) {
            $this->query("INSERT INTO {$this->foto_table} (id_tanggapan, foto) VALUES (:id_tanggapan, :foto)");
            $this->bind(':id_tanggapan', $tanggapanId);
            $this->bind(':foto', $photo);
            $this->execute();
        }
    }

    // Get photos of a specific tanggapan
    public function getTanggapanPhotos($tanggapanId)
    {
        $this->query("SELECT * FROM {$this->foto_table} WHERE id_tanggapan = :id_tanggapan");
        $this->bind(':id_tanggapan', $tanggapanId);
        return $this->resultSet(); // Returns an array of photos linked to a specific tanggapan
    }

    // Update an existing tanggapan
    public function updateTanggapan($id, $data)
    {
        $this->query("UPDATE {$this->table} SET tanggapan = :tanggapan, status = :status WHERE id = :id");
        $this->bind(':tanggapan', $data['tanggapan']);
        $this->bind(':status', $data['status']);
        $this->bind(':id', $id);

        return $this->execute(); // Executes the query and returns true/false based on success
    }

    // Delete tanggapan by ID
    public function deleteTanggapan($id)
    {
        $this->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute(); // Executes the deletion and returns true/false
    }

    // Delete photos of a specific tanggapan
    public function deleteTanggapanPhotos($tanggapanId)
    {
        $this->query("DELETE FROM {$this->foto_table} WHERE id_tanggapan = :id_tanggapan");
        $this->bind(':id_tanggapan', $tanggapanId);
        return $this->execute(); // Executes the deletion of photos
    }
}

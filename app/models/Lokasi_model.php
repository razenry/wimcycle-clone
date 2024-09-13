<?php
class Lokasi_model extends Database
{
    private $kota = "kota";
    private $kecamatan = "kecamatan";
    private $kelurahan = "kelurahan";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Mendapatkan semua data kota, kecamatan, dan kelurahan.
     *
     * @return array Data kota, kecamatan, dan kelurahan
     */
    public function getAllLocations()
    {
        // Query untuk mendapatkan semua data kota
        $this->query("SELECT * FROM $this->kota");
        $kotas = $this->resultSet();

        foreach ($kotas as &$kota) {
            $kotaId = $kota['id'];

            // Query untuk mendapatkan semua kecamatan berdasarkan ID kota
            $this->query("SELECT * FROM $this->kecamatan WHERE kota_id = :kota_id");
            $this->bind(':kota_id', $kotaId);
            $kecamatanList = $this->resultSet();

            foreach ($kecamatanList as &$kecamatan) {
                $kecamatanId = $kecamatan['id'];

                // Query untuk mendapatkan semua kelurahan berdasarkan ID kecamatan
                $this->query("SELECT * FROM $this->kelurahan WHERE kecamatan_id = :kecamatan_id");
                $this->bind(':kecamatan_id', $kecamatanId);
                $kelurahanList = $this->resultSet();

                $kecamatan['kelurahan'] = $kelurahanList;
            }

            $kota['kecamatan'] = $kecamatanList;
        }

        return $kotas;
    }
}

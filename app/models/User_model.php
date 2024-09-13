<?php

class User_model extends Database
{
    private $pengguna = "pengguna"; // Nama tabel pengguna
    private $petugas = "petugas"; // Nama tabel petugas

    public function __construct()
    {
        parent::__construct();
    }

    public function getPengguna($email = "")
    {
        if ($email !== "") {
            $this->query("SELECT * FROM $this->pengguna WHERE email = :email");
            $this->bind(':email', $email);
            return $this->single();
        } else {
            $this->query("SELECT * FROM $this->pengguna");
            return $this->resultSet();
        }
    }

    public function getPetugas($email = "")
    {
        if ($email !== "") {
            $this->query("SELECT * FROM $this->petugas WHERE email = :email");
            $this->bind(':email', $email);
            return $this->single();
        } else {
            $this->query("SELECT * FROM $this->petugas");
            return $this->resultSet();
        }
    }

    public function getPasswordByUserId($userId)
    {
        $this->query("SELECT password FROM pengguna WHERE id = :id");
        $this->bind(':id', $userId);
        return $this->single()['password'];
    }

    public function updatePassword($id, $hashedPassword)
    {
        $this->query("UPDATE pengguna SET password = :password WHERE id = :id");
        $this->bind(':password', $hashedPassword);
        $this->bind(':id', $id);

        return $this->execute();
    }


    public function generateNip($type = "")
    {
        $this->query("SELECT nip FROM $this->pengguna ORDER BY nip DESC LIMIT 1");
        $result = $this->single();

        if ($result) {
            $nip_db = $result['nip'];
            $nip_db_parts = explode("TGSL", $nip_db);

            if (isset($nip_db_parts[1])) {
                $no_baru = (int)$nip_db_parts[1] + 1;
            } else {
                $no_baru = 1;
            }

            $nip_baru = "TGSL" . str_pad($no_baru, 7, "0", STR_PAD_LEFT);
        } else {
            $nip_baru = "TGSL0000001";
        }

        return $nip_baru;
    }

    public function countUsers()
    {
        $this->query("SELECT COUNT(*) AS total FROM $this->pengguna");
        return $this->single();
    }

    public function countPetugas()
    {
        $this->query("SELECT COUNT(*) AS total FROM $this->petugas");
        return $this->single();
    }

    public function isEmailExist($email)
    {
        $this->query("SELECT email FROM $this->pengguna WHERE email = :email");
        $this->bind(':email', $email);
        $userEmail = $this->single();

        $this->query("SELECT email FROM $this->petugas WHERE email = :email");
        $this->bind(':email', $email);
        $petugasEmail = $this->single();

        if (!empty($userEmail['email']) || !empty($petugasEmail['email'])) {
            return true;
        }

        return false;
    }

    public function getAllData($table)
    {
        $this->query("SELECT * FROM $table");
        return $this->resultSet();
    }

    public function addData($data, $table)
    {
        if ($table == $this->pengguna) {
            $this->query("INSERT INTO $table (nama, foto, email, password, telp, status) VALUES (:nama, :foto, :email, :password, :telp, :status)");

            $this->bind(':nama', $data['nama']);
            $this->bind(':foto', $data['foto']);
            $this->bind(':email', $data['email']);
            $this->bind(':password', $data['password'] ?? '');
            $this->bind(':telp', $data['telp'] ?? '');
            $this->bind(':status', $data['status'] ?? '1');

            return $this->execute();
        } elseif ($table == $this->petugas) {
            $this->query("INSERT INTO $table (nama, foto, email, password, telp, status, level) VALUES (:nama, :foto, :email, :password, :telp, :status, :level)");

            $this->bind(':nama', $data['nama']);
            $this->bind(':foto', $data['foto']);
            $this->bind(':email', $data['email']);
            $this->bind(':password', $data['password'] ?? '');
            $this->bind(':telp', $data['telp'] ?? '');
            $this->bind(':status', $data['status'] ?? '');
            $this->bind(':level', $data['level'] ?? '');

            return $this->execute();
        }
    }

    public function updateData($id, $data, $table)
    {
        if ($table == $this->pengguna) {
            $this->query("UPDATE $table SET nama = :nama, foto = :foto, email = :email, password = :password, telp = :telp, status = :status WHERE id = :id");
            $this->bind(':nama', $data['nama']);
            $this->bind(':foto', $data['foto']);
            $this->bind(':email', $data['email']);
            $this->bind(':password', $data['password'] ?? '');
            $this->bind(':telp', $data['telp'] ?? '');
            $this->bind(':status', $data['status'] ?? '');
            $this->bind(':id', $id);
        } elseif ($table == $this->petugas) {
            $this->query("UPDATE $table SET nama = :nama, foto = :foto, email = :email, password = :password, telp = :telp, status = :status, level = :level WHERE id = :id");
            $this->bind(':nama', $data['nama']);
            $this->bind(':foto', $data['foto']);
            $this->bind(':email', $data['email']);
            $this->bind(':password', $data['password'] ?? '');
            $this->bind(':telp', $data['telp'] ?? '');
            $this->bind(':status', $data['status'] ?? '');
            $this->bind(':level', $data['level'] ?? '');
            $this->bind(':id', $id);
        }

        return $this->execute();
    }

    public function updateProfile($id, $data)
    {
        $this->query("UPDATE pengguna SET nama = :nama, foto = :foto, email = :email, telp = :telp  WHERE id = :id");
        $this->bind(':nama', $data['nama']);
        $this->bind(':foto', $data['foto']);
        $this->bind(':email', $data['email']);
        $this->bind(':telp', $data['telp'] ?? '');
        $this->bind(':id', $id);

        return $this->execute();
    }


    public function getById($id, $table)
    {
        $this->query("SELECT * FROM $table WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single();
    }

    public function deleteData($id, $table)
    {
        $users = $this->getById($id, $table);
        if ($users && $users['foto']) {
            $imagePath  = __DIR__ . "/../../public/storage/images/users/" . $users['foto'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->query("DELETE FROM $table WHERE id = :id");
        $this->bind(':id', $id);

        return $this->execute();
    }

    public function updateStatus($id, $status, $table)
    {
        $this->query("UPDATE $table SET status = :status WHERE id = :id");

        $this->bind(':status', $status);
        $this->bind(':id', $id);

        return $this->execute();
    }
}

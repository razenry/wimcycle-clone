<?php

// namespace App\User;
/**
 * Kelas User dengan metode statis getUserInfo
 */
class User
{
    // Metode statis untuk mendapatkan informasi pengguna
    public static function getUserInfo($user)
    {
        // Memeriksa apakah parameter $user adalah array
        if (!isset($user) || !is_array($user)) {
            return false;
        }

        // Memeriksa apakah kunci-kunci yang diperlukan ada dalam array $user
        $username = isset($user['username']) ? $user['username'] : 'Unknown';
        $email = isset($user['email']) ? $user['email'] : 'Unknown';
        $nama = isset($user['nama']) ? $user['nama'] : 'Unknown';

        // Mengembalikan array dengan informasi pengguna
        return [
            'username' => $username,
            'email' => $email,
            'nama' => $nama
        ];
    }
}
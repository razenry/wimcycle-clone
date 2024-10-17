<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent {
    public function __construct() {
        $capsule = new Capsule;

        // Konfigurasi koneksi database
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Set capsule instance
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

// Inisialisasi di awal aplikasi (misalnya di App.php atau index.php)
new Eloquent();

<?php 

// Seeder manual
use User;
use Post;

// Buat data pengguna
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com'
]);

// Buat post terkait pengguna
$user->posts()->create([
    'title' => 'My First Post',
    'body' => 'This is the body of the first post'
]);

<?php

// app/models/User.php
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';

    // Relasi dengan post
    public function posts() {
        return $this->hasMany(Post::class);
    }
}

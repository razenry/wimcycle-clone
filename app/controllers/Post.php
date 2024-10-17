<?php
// app/models/Post.php
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $table = 'posts';

    // Relasi dengan user
    public function user() {
        return $this->belongsTo(User::class);
    }
}

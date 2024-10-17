<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Contoh migrasi manual
Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamps();
});

Capsule::schema()->create('posts', function ($table) {
    $table->increments('id');
    $table->integer('user_id')->unsigned();
    $table->string('title');
    $table->text('body');
    $table->timestamps();

    // Foreign key constraint
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

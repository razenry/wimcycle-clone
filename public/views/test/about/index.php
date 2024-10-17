<div class="container mt-5">
    
    <?= App::extends('test/about/about') ?>
    <?= App::extends('test/about/card', ['title' => 'Hello']) ?>
    
    <h1>Category List</h1>
    
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= $category['name']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>



<?= App::extends('test/table', ['categories' => $categories]); ?>

<div class="container mt-5">
    <h1>Category List</h1>
    
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= $category['name']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php App::extends('test/test') ?>

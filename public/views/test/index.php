<?php $categories = CategoryModel::all(); ?>
<div class="container mt-5">
    <h1>Category List</h1>
    
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= $category['name']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php App::extends('test/table') ?>

<?php App::extends('test/test') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">About Us</h1>
            <p class="lead">
                <?= $categories[0]['name'] ?>
            </p>
            <p>
                <?= $categories[0]['description'] ?>
            </p>
        </div>
        <div class="col-md-6">
            <img src="<?= Routes::storage('categories/' . $categories[0]['photo']) ?>" class="img-fluid rounded" alt="About Us">
        </div>
    </div>
</div>
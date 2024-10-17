<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">Detail Category</h1>
            <p class="lead">
                <?= $category['name'] ?>
            </p>
            <p>
                <?= $category['description'] ?>
            </p>
        </div>
        <div class="col-md-6">
            <img src="<?= Routes::storage('categories/' . $category['photo']) ?>" class="img-fluid rounded" alt="<?= $category['name'] ?>">
        </div>

        <div class="mt-3">
            <a href="<?= Routes::base('beranda') ?>" class="btn btn-primary">Back</a>
        </div>

    </div>
</div>



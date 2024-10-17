<div class="card h-100 d-flex flex-column">

    <img src="<?= Routes::storage($cardImage) ?>" class="card-img-top scale" alt="CTB">
    <div class="card-body mt-3">
        <h5 class="card-title text-center fw-bold"><?= $cardTitle ?></h5>
        <p class="card-text text-center">
            <?= $cardDesc ?>
        </p>
    </div>
    <div class="card-footer d-flex justify-content-center mb-4">
        <a href="<?= $cardLink ?>" class="btn btn-primary rounded-pill px-3 py-2 bg-sec fw-bolder">
            <span><?= $cardButton ?></span>
            <i class="bi bi-arrow-right-circle-fill"></i>
        </a>
    </div>
</div>

<?php $category = CategoryModel::getById($product['category_id']); ?>

<img src="<?= Routes::public('assets/img/content/HEADER-PRODUK.jpg') ?>" class="img-fluid rounded-top" height="100px" alt="...">
<div class="container mt-5 ">
    
    <!-- Product Section -->
    <div class="row align-items-center">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="<?= Routes::storage('product/' . $product['product_photo']) ?>"
                class="img-fluid rounded shadow-lg"
                alt="<?= $product['product_name'] ?>">
        </div>
        <!-- Product Information -->
        <div class="col-lg-6">
            <h1 class="display-4 mb-2 fw-bold"><?= $product['product_name'] ?></h1>
            <p class="lead text-muted mb-1"><?= $product['category_name'] ?></p>
            <h3 class="text-primary mb-4 fw-semibold">Rp <?= number_format($product['product_price'], 0, ',', '.') ?></h3>
            <p class="mb-4"><?= $product['product_description'] ?></p>

            <!-- Product Frame and User Info -->
            <div class="bg-light p-4 rounded shadow-sm mb-4">
                <h5 class="fw-bold">Frame: <?= $product['frame_name'] ?></h5>
                <p class="mb-0"><?= $product['frame_description'] ?></p>
            </div>
            <div>
                <p class="text-muted small">
                    Added by: <strong><?= $product['user_name'] ?></strong> <br>
                    Contact: <a href="mailto:<?= $product['user_email'] ?>" class="text-decoration-underline"><?= $product['user_email'] ?></a>
                </p>
            </div>
        </div>
    </div>

    <?php $related_products = ProductModel::getRelatedProduct($category['slug'], $product['product_slug']); ?>


    <?php if (isset($related_products) && count($related_products) > 0): ?>
        <!-- Related Products Section -->
        <div class="row mt-5">
            <div class="col">
                <h2 class="mb-4 text-center">Produk Terkait Lainnya</h2>
                <div class="row justify-content-center g-4 mt-3">

                    <?php foreach ($related_products as $item) : ?>

                        <div class="col-12 col-md-6 col-lg-4">
                            <?= App::component('home/components/card', [
                                'cardTitle' => $item['product_name'],
                                'cardDesc' => $item['product_description'],
                                'cardImage' => 'product/' . $item['product_photo'],
                                'cardLink' => Routes::base('/produk/detail/') . $item['product_slug'],
                                'cardButton' => ($item['product_status'] == 1 ? 'Lihat Produk' : 'Belum Ada Produk')
                            ]);
                            ?>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Back Button Section -->
    <div class="row mt-5">
        <div class="col text-center">
            <a href="<?= Routes::base('/kategori/' . $category['slug']) ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
</div>
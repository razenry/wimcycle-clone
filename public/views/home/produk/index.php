<?php 

    // Set category name and description if available
    $pageName = $products[0]['product']['category']['name'] ?? null;
    $hero = "Category $pageName";
    $description = $products[0]['product']['category']['description'] ?? null;
?>

<!-- Hero Section -->
<?= App::component('home/produk/partials/hero-category', ['hero' => $hero, 'description' => $description]) ?>

<div class="container mt-lg-5">

    <!-- Check if products are available -->
    <?php if (!empty($products)) : ?>

        <!-- Products List -->
        <div class="row justify-content-center g-4 ">
            <?php foreach ($products as $item) : ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <?= App::component('home/components/card', [
                        'cardTitle' => $item['product']['name'],
                        'cardDesc' => $item['product']['description'],
                        'cardImage' => 'product/' . $item['product']['photo'],
                        'cardLink' => Routes::base('/produk/detail/') . $item['product']['slug'],
                        'cardButton' => ($item['product']['status'] == 1 ? 'Lihat Produk' : 'Belum Ada Produk')
                    ]);
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>
        
        <!-- No Products Message -->
        <div class="row justify-content-center mt-5">
            <div class="col text-center">
                <h3 class="text-muted">Produk tidak tersedia di kategori ini.</h3>
                <p class="text-muted">Silakan kembali nanti atau periksa kategori lainnya.</p>
            </div>
        </div>

    <?php endif; ?>

    <!-- Back Button Section -->
    <div class="row mt-5">
        <div class="col text-center">
            <a href="<?= Routes::base('/beranda') ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

</div>

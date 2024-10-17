<?= App::component('home/category/partials/hero-category', ['hero' => 'Produk']) ?>

<div class="container mt-lg-5">


    <div class="row justify-content-center g-4 ">

        <?php foreach ($categories as $category) : ?>

            <div class="col-12 col-md-6 col-lg-4">
                <?= App::component('home/components/card', [
                    'cardTitle' => $category['name'],
                    'cardDesc' => $category['description'],
                    'cardImage' => 'categories/' . $category['photo'],
                    'cardLink' => Routes::base('/beranda/detail/') . $category['slug'],
                    'cardButton' => ($category['status'] == 1 ? 'Lihat Semua' : 'Belum Ada Produk')
                ]);
                ?>
            </div>
            
        <?php endforeach; ?>

    </div>

</div>
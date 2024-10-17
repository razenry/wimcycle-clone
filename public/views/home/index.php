<img src="<?= Routes::public('assets/img/content/HEADER-PRODUK.jpg') ?>" class="img-fluid w-100 my-4 d-block d-sm-none" alt="...">

<?= App::extends('home/components/slide') ?>

<!-- About Start -->
<div class="container mt-3 text-center">
    <div class="card-body">
        <h5 class="card-title fw-bold fs-3">SEPEDA WIMCYCLE</h5>
        <p class="section-desc mt-2">
            Wimcycle menawarkan rangkaian sepeda berkualitas dengan desain yang
            stylish dan nyaman sesuai kebutuhan bersepeda keluarga Anda!
        </p>
    </div>
</div>
<!-- About End -->

<div class="container mb-4">
    <div class="section-line"></div>
</div>

<!-- Product Start -->
<div class="container mt-lg-5">


    <div class="row justify-content-center g-4 mt-2">

        <?php foreach ($categories as $category) : ?>

            <div class="col-12 col-md-6 col-lg-4">
                <?= App::component('home/components/card', [
                    'cardTitle' => $category['name'],
                    'cardDesc' => $category['description'],
                    'cardImage' => 'categories/' . $category['photo'],
                    'cardLink' => Routes::base('/kategori/') . $category['slug'],
                    'cardButton' => ($category['status'] == 1 ? 'Lihat Semua' : 'Belum Ada Produk')
                ]);
                ?>
            </div>
            
        <?php endforeach; ?>

    </div>

</div>
<!-- Product End -->

<!-- Latest Information Section -->
<div class="container mt-5 text-center">
    <div class="card-body">
        <h5 class="card-title fw-bold fs-3">INFORMASI TERBARU</h5>
        <p class="section-desc mt-4">
            Nantikan produk terbaru dari Wimcycle dengan desain lebih fresh dan colorful.
        </p>
    </div>
</div>

<div class="container mb-4">
    <div class="section-line"></div>
</div>

<!-- Info Section -->
<div class="container">
    <div class="row align-items-center latest-wrapper">
        <div class="col-md-6 text-center">
            <img src="<?= Routes::public('assets/img/content/MY23-BIGFOOT22-TRUCK-P1-1-467x350.jpg') ?>" class="img-fluid h-100">
        </div>
        <div class="col-md-6 d-flex flex-column text-center text-md-start justify-content-center gap-3">
            <h3 class="fw-bold">BMX Big foot Road 20</h3>
            <p>Sepeda BMX Bigfoot "Road" hadir dengan peningkatan dari seri sebelumnya "Solid Series". Seri "Road" menjawab semua pertanyaan Anda mengenai Big Foot yang tampil agresif dan arogan. Hadir dengan warna baru Red Light dan Green Light.</p>
            <div class="">
                <a href="#" class="btn btn-primary rounded-pill px-3 py-2 bg-sec fw-bolder">
                    <span>Lihat Semua</span>
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Info End -->
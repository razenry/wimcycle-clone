<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button class="" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= Routes::public('assets/img/slide1.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= Routes::public('assets/img/slide2.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= Routes::public('assets/img/slide3.jpg') ?>" class="d-block w-100" alt="...">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Slide End -->

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

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 d-flex flex-column">
                <img src="<?= Routes::public('assets/img/content/CTB-1-352x350.jpg') ?>" class="card-img-top scale" alt="CTB">
                <div class="card-body mt-3">
                    <h5 class="card-title text-center fw-bold">CTB</h5>
                    <p class="card-text text-center">
                        Sepeda yang cocok bagi Anda yang ingin berpergian dengan teman-teman untuk meningkatkan kebugatan tubuh.
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-center mb-4">
                    <a href="#" class="btn btn-primary rounded-pill px-3 py-2 bg-sec fw-bolder">
                        <span>Lihat Semua</span>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 d-flex flex-column">
                <img src="<?= Routes::public('assets/img/content/Sepeda-Lipat-16-352x350.jpg') ?>" class="card-img-top scale" alt="Sepeda Lipat">
                <div class="card-body mt-3">
                    <h5 class="card-title text-center fw-bold">Sepeda Lipat</h5>
                    <p class="card-text text-center">
                        Sepeda lipat yang cocok bagi Anda untuk menjelajahi kota.
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-center mb-4">
                    <a href="#" class="btn btn-primary rounded-pill px-3 py-2 bg-sec fw-bolder">
                        <span>Lihat Semua</span>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 d-flex flex-column">
                <img src="<?= Routes::public('assets/img/content/COVER_MTB-352x350.jpg') ?>" class="card-img-top scale" alt="Sepeda Gunung (MTB)">
                <div class="card-body mt-3">
                    <h5 class="card-title text-center fw-bold">Sepeda Gunung (MTB)</h5>
                    <p class="card-text text-center">
                        Sepeda yang cocok bagi Anda ingin merasakan sepeda gunung serbaguna untuk off-road ringan di akhir pekan.
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-center mb-4">
                    <a href="#" class="btn btn-primary rounded-pill px-3 py-2 bg-sec fw-bolder">
                        <span>Lihat Semua</span>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>

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
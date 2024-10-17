<!-- Header Section Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-5 py-3 fixed-top rounded-bottom-5">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
            <img src="<?= Routes::public('assets/img/content/logoWimcycle.png') ?>" width="180px" alt="Logo Wimcycle" />
        </a>

        <!-- Hamburger Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex gap-3 fs-5 align-items-center">
                <li class="nav-item">
                    <a class="nav-link active fw-bold mx-3" aria-current="page" href="<?= Routes::base('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Dukungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Dealer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Wimmers Fun Day</a>
                </li>
            </ul>

            <!-- Search Bar -->
            <form class="d-flex justify-content-center" method="POST">
                <div class="search-container">
                    <input type="text" id="inputContainer" class="d-none rounded-pill input-animation" name="keyword" />
                    <button class="btn btn-dark-1 rounded-circle search d-none" type="submit" id="submitButton">
                        <i class="bi bi-search fw-5 font fw-bold"></i>
                    </button>
                </div>
            </form>
            <button class="btn btn-dark-1 rounded-circle search" type="button" id="searchButton">
                <i class="bi bi-search fw-5 font fw-bold"></i>
            </button>
        </div>
    </div>
</nav>
<!-- Header Section End -->

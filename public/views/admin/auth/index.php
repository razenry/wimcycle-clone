<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="<?= Routes::base() ?>" class="navbar-brand navbar-brand-autodark">
                <img src="<?= Routes::public('assets/img/content/logoWimcycle.png') ?>" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Masuk ke akun anda</h2>
                <form action="<?= Routes::base('auth/login') ?>" method="POST" autocomplete="off" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="emailmu@email.com" autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Kata Sandi</label>
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control" name="password" placeholder="Kata sandi anda" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Icon -->
    <link rel="shortcut icon" href="<?= Routes::assets('img/logo/image-removebg-preview.png') ?>" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Bootstrap ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= Routes::public('assets/css/bootstrap-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= Routes::public('assets/css/app.css') ?>" />
    <link rel="stylesheet" href="<?= Routes::public('assets/css/loader.css') ?>" />

    <title><?= $title ?? 'Wimcycle' ?> | Razenry</title>
</head>

<body>

    <!-- Navbar -->
    <?= App::extends('home/layouts/navbar') ?>
    
    <!-- Loader -->
    <?= App::extends('home/layouts/loader') ?>

    <?= $content; ?>

    <!-- Footer -->

    <?= App::extends('home/layouts/footer') ?>
    <!-- My JS -->
    <script src="<?= Routes::public('assets/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= Routes::public('assets/js/app.js') ?>"></script>
    <script src="<?= Routes::public('assets/js/loader.js') ?>"></script>
</body>

</html>
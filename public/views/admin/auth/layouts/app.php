<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $title ?></title>
    <!-- CSS files -->
    <link rel="shortcut icon" href="<?= Routes::assets('img/logo/image-removebg-preview.png') ?>" type="image/x-icon">
    <link href="<?= Routes::assets('dist/css/tabler.min.css?1692870487') ?>" rel="stylesheet" />
    <link href="<?= Routes::assets('dist/css/tabler-flags.min.css?1692870487') ?>" rel="stylesheet" />
    <link href="<?= Routes::assets('dist/css/tabler-payments.min.css?1692870487') ?>" rel="stylesheet" />
    <link href="<?= Routes::assets('dist/css/tabler-vendors.min.css?1692870487') ?>" rel="stylesheet" />
    <link href="<?= Routes::assets('dist/css/demo.min.css?1692870487') ?>" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="<?= Routes::assets('dist/js/demo-theme.min.js?1692870487') ?>"></script>
    

    <?= $content ?>

    
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?= Routes::assets('dist/js/tabler.min.js?1692870487') ?>" defer></script>
    <script src="<?= Routes::assets('dist/js/demo.min.js?1692870487') ?>" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($_SESSION['gagal'])) : ?>
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "<?= $_SESSION['gagal'] ?>",
                icon: "error"
            });
        </script>
        <?php unset($_SESSION['gagal']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['berhasil'])) : ?>
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "<?= $_SESSION['berhasil'] ?>",
                icon: "success"
            });
        </script>
        <?php unset($_SESSION['berhasil']); ?>
    <?php endif; ?>



</body>

</html>
<?php

$pageTitle = isset($data['pageTitle'])? $data['pageTitle'] : 'Dashboard';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $pageTitle ?> - Wimcycle</title>
    <link rel="shortcut icon" href="<?= Routes::assets('img/logo/image-removebg-preview.png') ?>" type="image/x-icon">
    <!-- CSS files -->
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

<body>
    <script src="<?= Routes::assets('dist/js/demo-theme.min.js?1692870487') ?>"></script>
    <div class="page">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Application' ?></title>
</head>
<body>

    <header>
        <?= App::extends('test/layout/navbar') ?>
    </header>
    
    <main>
        <!-- Konten view di-inject ke sini -->
        <?= $content; ?>
    </main>
    <footer>
        
        <?= App::extends('test/layout/footer') ?>
    </footer>

</body>
</html>

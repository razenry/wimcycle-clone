<?php
$message = $data['message'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #111;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .glitch-wrapper {
            text-align: center;
            max-width: 100%;
            padding: 0 20px;
        }

        .glitch {
            position: relative;
            font-size: 5rem;
            font-weight: 700;
            color: #fff;
        }

        .glitch::before,
        .glitch::after {
            content: '404';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            overflow: hidden;
        }

        .glitch::before {
            left: 2px;
            text-shadow: -2px 0 red;
            animation: glitch 0.8s infinite linear alternate-reverse;
        }

        .glitch::after {
            left: -2px;
            text-shadow: -2px 0 blue;
            animation: glitch 0.8s infinite linear alternate-reverse;
        }

        @keyframes glitch {
            0% {
                transform: translate(0);
            }

            20% {
                transform: translate(-3px, 3px);
            }

            40% {
                transform: translate(3px, -3px);
            }

            60% {
                transform: translate(-2px, 2px);
            }

            80% {
                transform: translate(2px, -2px);
            }

            100% {
                transform: translate(0);
            }
        }

        .description {
            font-size: 1.2rem;
            margin-top: 5px;
        }

        .btn-custom {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-custom:hover {
            background-color: darkblue;
        }

        @media (max-width: 768px) {
            .glitch {
                font-size: 3rem;
            }

            .description {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .glitch {
                font-size: 2.5rem;
            }

            .description {
                font-size: 0.9rem;
            }

            .btn-custom {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="glitch-wrapper">
        <div class="glitch">404</div>
        <p class="description">Oops! Halaman <span class="fw-bold text-primary"><?= $message ?></span> tidak di temukan.</p>
        <a href="<?= Routes::base('beranda') ?>" class="btn btn-primary">Kembali</a>
    </div>

</body>

</html>
<?php

session_start();

include('../../app/functions/base_url.php');
include('../../app/functions/db_connect.php');
include('../../app/functions/query.php');
include('../../app/functions/authority_check.php');
include('../../app/functions/date_formatter.php');
include('../../app/functions/fullname_check.php');

$slug = $_GET['id'];

$result = query("SELECT * FROM td_news WHERE slug = '$slug' LIMIT 1")[0];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>EBS FM UNHAS</title>





    <link href="<?= $BASE_URL ?>css/style.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body style="background-image: url('<?= $BASE_URL ?>img/bg.jpg');" class="bg-size-cover">

    <?php include('../../nav/navbar.php') ?>

    <main>
        <?php include('../../header/header.php') ?>

        <section class="container mb-5 pb-5">
            <div class="row justify-content-center my-5 pb-3">
                <div class="col">
                    <div class="card rounded-5 shadow">
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result['foto'] ?>" alt="" class="w-100 rounded-5">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <p class="fs-5"><?= $result['penulis'] ?> <span class="text-muted">- <?= date_formatter($result['tgl_terbit'], 'dd mmm yyyy') ?></span></p>
                                    <h1 class="fs-2 heading-article mb-3"><?= $result['judul'] ?></h1>
                                    <p class="fs-4 text-muted"><?= $result['konten'] ?></p>
                                    <a href="<?= $BASE_URL ?>news/" class="mt-5 fw-bold">
                                        <p class="fs-1"><i class="bi bi-arrow-left"></i></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </main>

    <?php include('../../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        document.querySelector('#nav-link-news').classList.add('active');
    </script>
</body>

</html>
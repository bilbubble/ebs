<?php

session_start();
include('../app/functions/base_url.php');
include('../app/functions/db_connect.php');
include('../app/functions/query.php');
include('../app/functions/authority_check.php');
include('../app/functions/fullname_check.php');
include('../app/functions/date_formatter.php');

$result_news = query("SELECT * FROM td_news WHERE rubrik <> 'EBS Music BOX' ORDER BY id DESC LIMIT 3");
$result_music_box = query("SELECT * FROM td_news WHERE rubrik = 'EBS Music BOX' ORDER BY id DESC LIMIT 2");

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

    <?php include('../nav/navbar.php') ?>

    <main>
        <?php include('../header/header.php') ?>

        <section class="container">
            <div class="row my-5">
                <div class="col mt-5">
                    <h1 class="d-inline border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg">EBS NEWS&ensp;&ensp;</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <?php for ($i = 1; $i <= 2; $i++) : ?>
                        <?php if (isset($result_news[$i])) : ?>
                            <div class="card rounded-5 mb-5">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <img src="<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_news[$i]['foto'] ?>" alt="" class="w-100 rounded-5 object-fit-cover" style="height: 30vh;">
                                        </div>
                                        <div class="col-lg-7">
                                            <a href="<?= $BASE_URL ?>news/views?id=<?= $result_news[$i]['slug'] ?>" class="stretched-link">
                                                <h2 class="article-content fw-semibold truncate-2-line my-3"><?= $result_news[$i]['judul'] ?></h2>
                                            </a>
                                            <p class="truncate-2-line"><?= $result_news[$i]['konten'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endfor ?>

                </div>

                <?php if (isset($result_news[0])) : ?>
                    <div class="col-lg-4 order-first order-lg-last">
                        <div class="row">
                            <div class="col">
                                <div class="card rounded-5 mb-5">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-12 mb-4">
                                                <img src="<?= $BASE_URL ?>/app/data/img/foto-berita/<?= $result_news[0]['foto'] ?>" alt="" class="w-100 rounded-5 object-fit-cover" style="height: 30vh;">
                                            </div>
                                            <div class="col-12">
                                                <a href="<?= $BASE_URL ?>news/views?id=<?= $result_news[0]['slug'] ?>" class="stretched-link">

                                                    <h2 class="article-content fw-semibold truncate-2-line"><?= $result_news[0]['judul'] ?></h2>
                                                </a>
                                                <p class="truncate-8-line"><?= $result_news[0]['konten'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>


        <section class="container mb-5 pb-5">
            <div class="row my-5">
                <div class="col mt-5">
                    <h1 class="d-inline border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg">EBS MUSIC BOX&ensp;&ensp;</h1>
                </div>
            </div>

            <div class="row">
                <?php foreach ($result_music_box as $music_box) : ?>
                    <div class="col-lg-6">
                        <div class="card rounded-5 mb-5">
                            <div class="card-body p-0">
                                <div class="row align-items-center">
                                    <div class="col-lg-5">
                                        <img src="<?= $BASE_URL ?>app/data/img/foto-berita/<?= $music_box['foto'] ?>" alt="" class="w-100 rounded-start-5 object-fit-cover" style="height: 30vh;">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="d-flex align-items-start flex-column py-3" style="height: 30vh;">
                                            <div class="p-2">By / Admin</div>
                                            <a href="<?= $BASE_URL ?>news/views?id=<?= $music_box['slug'] ?>" class="my-auto stretched-link">
                                                <h3 class="article-content fw-semibold truncate-2-line"><?= $music_box['judul'] ?></h3>
                                            </a>
                                            <div class="p-2"><?= date_formatter($music_box['tgl_terbit'], 'dd mmmm yyyy') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>


            </div>
        </section>
    </main>

    <?php include('../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        document.querySelector('#nav-link-news').classList.add('active');
    </script>
</body>

</html>
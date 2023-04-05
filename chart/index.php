<?php

session_start();

include('../app/functions/base_url.php');
include('../app/functions/db_connect.php');
include('../app/functions/query.php');
include('../app/functions/authority_check.php');
include('../app/functions/fullname_check.php');

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

        <section class="container mb-5 pb-5">
            <div class="row mt-5 mb-4">
                <div class="col mt-5">
                    <h1 class="d-inline border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg">EBS GLOBAL TOP 10&ensp;&ensp;</h1>
                    <p class="fs-3 fw-semibold mt-2">This Week on Chart</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table text-center bg-white">
                        <thead class="bg-cream">
                            <tr>
                                <th scope="col">
                                    <h6 class="my-3">#</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="my-3">Songs</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="my-3">Last Week</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="my-3">Week on Chart</h6>
                                </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <?php if ($i % 2 == 0) : ?>
                                    <tr class="fw-bold">
                                        <td scope="row"><?= $i ?></td>
                                        <td class="text-start">
                                            <p class="fs-5 fw-bold mb-0 mt-2">Alive</p>
                                            <p>Stereowall</p>
                                        </td>
                                        <td>01</td>
                                        <td>02</td>
                                        <td><img src="https://statics.indozone.news/content/2022/07/01/x0sLLBD/niat-seru-seruan-stereo-wall-kini-resmi-bergabung-bersama-musica-studios85_700.jpg" alt="" style="width: 20vh; height: 20vh" class="object-fit-cover rounded"></td>
                                    </tr>
                                <?php else : ?>
                                    <tr class="fw-bold">
                                        <td scope="row"><?= $i ?></td>
                                        <td class="text-start">
                                            <p class="fs-5 fw-bold mb-0 mt-2">Perayaan Patah Hari</p>
                                            <p>For Revenge</p>
                                        </td>
                                        <td>02</td>
                                        <td>01</td>
                                        <td><img src="https://cdn1-production-images-kly.akamaized.net/7_BQEWe2qOLp4u5kCuXlJOpKXyY=/1200x1200/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3935190/original/096911500_1644936000-WhatsApp_Image_2022-02-15_at_12.29.12.jpeg" alt="" style="width: 20vh; height: 20vh;" class="object-fit-cover rounded"></td>
                                    </tr>
                                <?php endif ?>
                            <?php endfor ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>

    <?php include('../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        document.querySelector('#nav-link-chart').classList.add('active');
    </script>
</body>

</html>
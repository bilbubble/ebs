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
                <div class="col mt-5 mb-4">
                    <h1 class="d-inline border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg">ABOUT US&ensp;&ensp;</h1>
                </div>
            </div>
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-lg-10">
                    <div class="card rounded-5 shadow">
                        <div class="card-body">
                            <img src="<?= $BASE_URL ?>app/data/img/about/about-1.png" alt="" class="w-100 rounded-5">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-lg-10">
                    <div class="card rounded-5 shadow">
                        <div class="card-body">
                            <img src="<?= $BASE_URL ?>app/data/img/about/about-2.png" alt="" class="w-100 rounded-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-lg-8">
                    <div class="card rounded-5 shadow">
                        <div class="card-body">
                            <img src="<?= $BASE_URL ?>app/data/img/about/about-3.png" alt="" class="w-100 rounded-5">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        document.querySelector('#nav-link-about').classList.add('active');
    </script>
</body>

</html>
<?php

session_start();

include('../../app/functions/base_url.php');
include('../../app/functions/db_connect.php');
include('../../app/functions/query.php');
include('../../app/functions/authority_check.php');
include('../../app/functions/fullname_check.php');

echo authority_check() !== "editor" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$results = query("SELECT * FROM td_chart ORDER BY peringkat_minggu_ini");

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

        <section class="container mb-5 pb-5">
            <div class="row mt-5 pt-5 mb-4">
                <div class="col mt-5">
                    <h1 class="d-inline border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg">EBS GLOBAL TOP 10&ensp;&ensp;</h1>
                    <p class="fs-3 fw-semibold mt-2">This Week on Chart</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <a href="<?= $BASE_URL ?>editor/chart/add" class="btn btn-success btn-lg mb-4"><i class="bi bi-plus-lg"></i>&ensp;Add More</a>
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
                            <?php $i = 0;
                            foreach ($results as $result) : $i++; ?>
                                <tr class="fw-bold">
                                    <td scope="row"><?= $i ?></td>
                                    <td class="text-start">
                                        <p class="fs-5 fw-bold mb-0 mt-2"><?= $result['judul'] ?></p>
                                        <p><?= $result['artis'] ?></p>
                                    </td>
                                    <td><?= $result['peringkat_minggu_lalu'] ?></td>
                                    <td><?= $result['peringkat_minggu_ini'] ?></td>
                                    <td>
                                        <img src="<?= $BASE_URL ?>app/data/img/foto-chart/<?= $result['foto'] ?>" alt="" style="width: 25vh; height: 25vh" class="object-fit-cover rounded">
                                        <div>
                                            <a href="<?= $BASE_URL ?>editor/chart/edit?id=<?= $result['slug'] ?>" class="btn btn-sm btn-outline-primary bg-primary my-2 px-lg-3 rounded-pill bg-opacity-25 text-primary border-0"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger border-0 my-2 px-lg-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#modal<?= $result['id'] ?>"><i class="bi bi-trash3"></i>&nbsp;Delete</butto>
                                        </div>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal<?= $result['id'] ?>" tabindex="-1" aria-labelledby="modal<?= $result['id'] ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="modal-title fs-5 fw-semibold" id="modal<?= $result['id'] ?>Label">Are You Sure ?</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin ingin menghapus <span class="fw-semibold"><?= $result['judul'] . ' - ' . $result['artis'] ?></span> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" onclick="window.location.replace('<?= $BASE_URL ?>editor/chart/delete?id=<?= $result['id'] ?>')" class="btn btn-primary">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>

    <?php include('../../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        let nav_link_chart = document.querySelector('#nav-link-chart')
        nav_link_chart.setAttribute("href", '<?= $BASE_URL ?>editor/chart')
        nav_link_chart.classList.add('active')

        document.querySelector('#nav-link-news').setAttribute('href', '<?= $BASE_URL ?>editor/news')
    </script>
</body>

</html>
<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/query.php');
include('../../../app/functions/date_formatter.php');
include('../../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$slug = $_GET['id'];

$result = query("SELECT * FROM td_surat_masuk WHERE slug = '$slug' LIMIT 1")[0];

if (isset($_POST['submit'])) {
    $nama = $_POST['artis'];
    $judul = $_POST['judul-lagu'];
    $tanggal = $_POST['tanggal-rilis'];

    mysqli_query($conn, "UPDATE td_surat_masuk SET nama = '$nama', judul = '$judul', tanggal = '$tanggal' WHERE slug = '$slug'");
    echo "<script>window.location.replace('" . $BASE_URL . "admin/press-release')</script>";
}
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

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

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


    <!-- Custom styles for this template -->
    <link href="<?= $BASE_URL ?>admin/css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

    <header class="d-md-none navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand bg-primary border-0 shadow-none col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">EBS FM UNHAS</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">

            <?php include('../../sidebar/sidebar.php') ?>

            <?php include('../../navbar/navbar.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div class="bg-opacity-75 rounded-4 my-3">
                        <p class=" fw-normal mb-0"><span class="opacity-50">Pages / Media Partner</span> / <?= $result['judul'] ?></p>
                        <p class="fs-3 fw-semibold">Media Partner</p>
                    </div>

                    <form action="" method="post">

                        <div class="row justify-content-center mb-5 pb-3">
                            <div class="col">
                                <div class="card border-0">
                                    <div class="card-body p-lg-5">
                                        <div class="mb-5">
                                            <label for="artis" class="form-label">
                                                <p class="fs-4 text-muted mb-1">Artis</p>
                                            </label>
                                            <input type="text" class="form-control" id="artis" name="artis" placeholder="Enter text" value="<?= $result['nama'] ?>" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="judul-lagu" class="form-label">
                                                <p class="fs-4 text-muted mb-1">Judul Lagu</p>
                                            </label>
                                            <input type="text" class="form-control" id="judul-lagu" name="judul-lagu" placeholder="Enter text" value="<?= $result['judul'] ?>" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="tanggal-rilis" class="form-label">
                                                <p class="fs-4 text-muted mb-1">Tanggal Rilis</p>
                                            </label>
                                            <input type="date" class="form-control" id="tanggal-rilis" name="tanggal-rilis" placeholder="Enter text" value="<?= $result['tanggal'] ?>" required>
                                        </div>

                                        <div class="mb-5">
                                            <label class="form-label">
                                                <p class="fs-4 text-muted mb-1">Additional File</p>
                                            </label>
                                            <br>
                                            <a class="btn btn-outline-pink btn-lg px-5" href="<?= $BASE_URL ?>app/data/file/press-release/<?= $result['file'] ?>" download="<?= $result['nama'] . ' - ' . $result['judul'] ?>"><i class="bi bi-file-earmark-fill"></i>&ensp;Download</a>
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-success btn-lg px-5 mt-5 mx-auto rounded-0" id="submit" name="submit">
                                                <div class="px-5">Save Changes</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </main>
        </div>
    </div>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        document.getElementById('icon-press-release').classList.add('bg-primary', 'text-white');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>
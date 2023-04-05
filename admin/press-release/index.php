<?php

session_start();

include('../../app/functions/base_url.php');
include('../../app/functions/db_connect.php');
include('../../app/functions/query.php');
include('../../app/functions/date_formatter.php');
include('../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$id = '';
$year = '';
if (isset($_GET['id'])) {
    $id = str_replace(['PR', '#'], '', $_GET['id']);
}

if (isset($_GET['year'])) {
    $year = $_GET['year'];
}

$results = query("SELECT * FROM td_surat_masuk WHERE jenis = 'press release' AND id LIKE '%$id%' AND YEAR(tanggal) LIKE '%$year%' ORDER BY id DESC");

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

            <?php include('../sidebar/sidebar.php') ?>

            <?php include('../navbar/navbar.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div class="bg-opacity-75 rounded-4 my-3">
                        <p class=" fw-normal mb-0"><span class="opacity-50">Pages</span> / Press Release</p>
                        <p class="fs-3 fw-semibold">Press Release</p>
                    </div>

                    <form action="" method="get">
                        <div class="row mt-5">
                            <div class="col-md-8 col-lg-6 col-xl-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="id" class="form-label">
                                                <p class="fw-semibold fs-5 mb-0">Select by ID</p>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" id="id" name="id" placeholder="Enter ID" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">
                                                <p class="fw-semibold fs-5 mb-0">Select by Year</p>
                                            </label>
                                            <select class="form-select form-select-lg" id="year" name="year" aria-label="Default select example">
                                                <option value="">All</option>
                                                <?php for ($i = date("Y"); $i > date("Y") - 10; $i--) : ?>
                                                    <option value="<?= $i ?>" <?= $year == $i ? "selected" : "" ?>><?= $i ?></option>
                                                <?php endfor ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label class="form-label">
                                            <p class="fw-semibold fs-5 mb-0">&nbsp;</p>
                                        </label>
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-lg" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col">

                            <div class="card border-0 shadow-0">
                                <div class="card-body">

                                    <table class="table text-center">
                                        <thead>
                                            <tr class="fw-bold">
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">ID</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Date</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Title</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Type</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Detail</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $result) : ?>
                                                <tr class="text-muted fw-semibold align-middle">
                                                    <td class="border-0 fs-6 py-3"><a class="text-decoration-none">#PR<?= $result['id'] ?></a></td>
                                                    <td class="border-0 fs-6 py-3"><?= date_formatter($result['tanggal'], 'dd/mm/yyyy') ?></td>
                                                    <td class="border-0 fs-6 py-3"><?= $result['nama'] ?></td>
                                                    <td class="border-0 fs-6 py-3">Press Release</td>
                                                    <td class="border-0 fs-6 py-3">
                                                        <a href="<?= $BASE_URL ?>app/data/file/press-release/<?= $result['file'] ?>" download="<?= $result['nama'] . ' - ' . $result['judul'] ?>" class="btn btn-white fw-semibold">PDF</a>
                                                    </td>
                                                    <td class="border-0 fs-6 py-3">
                                                        <button onclick="window.location.href = '<?= $BASE_URL ?>admin/press-release/edit?id=<?= $result['slug'] ?>'" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm my-1"><i class="bi bi-vector-pen"></i>&nbsp;Edit</bu>
                                                            <button data-bs-toggle="modal" data-bs-target="#modal<?= $result['id'] ?>" type="button" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0 my-1">Delete</button>
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
                                                                    File tidak dapat dipulihkan kembali setelah dihapus !
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-primary" onclick="window.location.replace('<?= $BASE_URL ?>admin/press-release/delete?id=<?= $result['id'] ?>')">Delete</button>
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
                        </div>
                    </div>
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
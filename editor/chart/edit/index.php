<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/query.php');
include('../../../app/functions/authority_check.php');
include('../../../app/functions/fullname_check.php');
include('../../../app/functions/upload_file.php');
include('../../../app/functions/slug_maker.php');

echo authority_check() !== "editor" ? "<script>window.location.replace('$BASE_URL')</script>" : "";


$slug = $_GET['id'];

$result = query("SELECT * FROM td_chart WHERE slug = '$slug' LIMIT 1")[0];

$judul = $result['judul'];
$artis = $result['artis'];
$peringkat_minggu_ini = $result['peringkat_minggu_ini'];
$peringkat_minggu_lalu = $result['peringkat_minggu_lalu'];
$foto = $result['foto'];

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $artis = $_POST['artis'];
    $peringkat_minggu_ini = $_POST['peringkat-minggu-ini'];
    $peringkat_minggu_lalu = $_POST['peringkat-minggu-lalu'];

    if ($_FILES['foto']['name']) {
        $foto = uploadFile($_FILES['foto'], '../../../app/data/img/foto-chart/');
    }

    mysqli_query($conn, "UPDATE td_chart SET judul = '$judul', artis = '$artis', peringkat_minggu_ini = '$peringkat_minggu_ini', peringkat_minggu_lalu = '$peringkat_minggu_lalu', foto = '$foto' WHERE slug = '$slug'");
    echo "<script>window.location.replace('" . $BASE_URL . "editor/chart')</script>";
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

    <?php include('../../../nav/navbar.php') ?>

    <main class="pt-5">

        <section class="container mb-5 py-5">
            <div class="row mt-5 mb-4">
                <div class="col my-5">
                    <div class="d-flex">
                        <h1 class="mx-auto border-dark border-bottom border-4 bigger-heading text-shadow-sm">Edit Chart</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5 pb-3">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="col">
                        <div class="card rounded-5 shadow">
                            <div class="card-body p-lg-5 m-4">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <label for="judul" class="form-label">
                                            <p class="fs-3 text-muted mb-1">Judul Lagu <span class="text-danger">*</span></p>
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="judul" name="judul" placeholder="Enter text" value="<?= $result['judul'] ?>" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="artis" class="form-label">
                                            <p class="fs-3 text-muted mb-1">Artis <span class="text-danger">*</span></p>
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="artis" name="artis" placeholder="Enter text" value="<?= $result['artis'] ?>" required>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <div class="mb-4">
                                                <label for="peringkat-minggu-ini" class="form-label">
                                                    <p class="fs-3 text-muted mb-1">Peringkat Minggu Ini <span class="text-danger">*</span></p>
                                                </label>
                                                <input type="number" class="form-control form-control-lg" id="peringkat-minggu-ini" name="peringkat-minggu-ini" value="<?= $result['peringkat_minggu_ini'] ?>" min="1" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="peringkat-minggu-lalu" class="form-label">
                                                    <p class="fs-3 text-muted mb-1">Peringkat Minggu Lalu <span class="text-danger">*</span></p>
                                                </label>
                                                <input type="number" class="form-control form-control-lg" id="peringkat-minggu-lalu" name="peringkat-minggu-lalu" value="<?= $result['peringkat_minggu_lalu'] ?>" min="1" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mt-5">
                                            <label for="foto" class="cursor-pointer">
                                                <div id="form-input-border" class="border border-1">
                                                    <img src="<?= $BASE_URL ?>app/data/img/foto-chart/<?= $result['foto'] ?>" id="fotoPreview" class="rounded w-100" alt="">
                                                </div>
                                                <p class="text-muted">Attach file.File size of your document should not exceed 10 MB</p>
                                            </label>

                                            <input class="d-none" type="file" name="foto" id="foto" accept="image/*" onchange="loadFile(event)">
                                        </div>

                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg px-5 mt-5 mx-auto rounded-0">
                                            <div class="px-5">Submit</div>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php include('../../../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>

    <script>
        let nav_link_chart = document.querySelector('#nav-link-chart')
        nav_link_chart.setAttribute("href", '<?= $BASE_URL ?>editor/chart')
        nav_link_chart.classList.add('active')

        document.querySelector('#nav-link-news').setAttribute('href', '<?= $BASE_URL ?>editor/news')

        var loadFile = function(event) {
            var fotoPreview = document.getElementById('fotoPreview');
            fotoPreview.src = URL.createObjectURL(event.target.files[0]);
            fotoPreview.onload = function() {
                URL.revokeObjectURL(fotoPreview.src) // free memory
            }
        };
    </script>

</body>

</html>
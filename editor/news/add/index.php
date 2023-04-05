<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/query.php');
include('../../../app/functions/slug_maker.php');
include('../../../app/functions/upload_file.php');
include('../../../app/functions/authority_check.php');
include('../../../app/functions/fullname_check.php');

echo authority_check() !== "editor" ? "<script>window.location.replace('$BASE_URL')</script>" : "";


$judul = "";
$penulis = "";
$konten = "";
$rubrik = "";
$tgl_terbit = "";
$foto = "";

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $konten = $_POST['konten'];
    $rubrik = $_POST['rubrik'];
    $tgl_terbit = $_POST['tgl-terbit'];
    $slug = slug_maker($judul, 'td_news');
    if ($_FILES['foto']['name']) {
        $foto = uploadFile($_FILES['foto'], '../../../app/data/img/foto-berita/');
    }

    mysqli_query($conn, "INSERT INTO td_news VALUES ('', '$judul', '$slug', '$penulis', '$konten', '$rubrik', '$tgl_terbit', '$foto')");
    echo "<script>window.location.replace('" . $BASE_URL . "editor/news')</script>";
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
                        <h1 class="mx-auto border-dark border-bottom border-4 bigger-heading text-shadow-sm">Add News</h1>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col">
                        <div class="card rounded-5 shadow">
                            <div class="card-body p-lg-5 m-4">
                                <div class="mb-5">
                                    <label for="judul" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Judul Berita <span class="text-danger">*</span></p>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="judul" name="judul" placeholder="Enter text" required>
                                </div>

                                <div class="mb-5">
                                    <label for="penulis" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Penulis <span class="text-danger">*</span></p>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="penulis" name="penulis" placeholder="Enter text" required>
                                </div>

                                <div class="mb-5">
                                    <label for="konten" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Konten <span class="text-danger">*</span></p>
                                    </label>
                                    <textarea class="form-control form-control-lg" id="konten" name="konten" rows="7" placeholder="Enter text" required></textarea>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <div class="mb-5">
                                            <label for="rubrik" class="form-label">
                                                <p class="fs-3 text-muted mb-1">Rubrik <span class="text-danger" required>*</span></p>
                                            </label>
                                            <select class="form-select form-select-lg" id="rubrik" name="rubrik">
                                                <option value="EBS News" selected>EBS News</option>
                                                <option value="EBS Music Box">EBS Music Box</option>
                                                <option value="Lifestyle">Lifestyle</option>
                                                <option value="Sports">Sports</option>
                                                <option value="Education">Education</option>
                                            </select>
                                        </div>
                                        <div class="mb-5">
                                            <label for="tgl-terbit" class="form-label">
                                                <p class="fs-3 text-muted mb-1">Tanggal Terbit <span class="text-danger">*</span></p>
                                            </label>
                                            <input type="date" class="form-control form-control-lg" id="tgl-terbit" name="tgl-terbit" placeholder="Enter date" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mt-5">
                                        <label for="foto">
                                            <div id="form-input-border" class="border border-1 cursor-pointer">
                                                <p id="p-preview" class="text-center mb-0 py-5"><i class="bi bi-upload"></i>&ensp;Upload Additional File</p>
                                                <img id="fotoPreview" class="d-none rounded w-100" alt="">
                                            </div>
                                            <p class="text-muted">Attach file.File size of your document should not exceed 10 MB</p>
                                        </label>

                                        <input class="d-none" type="file" onchange="loadFile(event)" name="foto" id="foto" accept="image/*" required>
                                    </div>

                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-success btn-lg px-5 mt-5 mx-auto rounded-0" id="submit" name="submit">
                                        <div class="px-5">Submit</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <?php include('../../../footer/footer.php') ?>


    <script src="<?= $BASE_URL ?>js/script.js"></script>
    <script>
        var loadFile = function(event) {
            var fotoPreview = document.getElementById('fotoPreview');
            fotoPreview.src = URL.createObjectURL(event.target.files[0]);
            fotoPreview.onload = function() {
                URL.revokeObjectURL(fotoPreview.src) // free memory
            }
            document.getElementById("form-input-border").classList.remove('border-danger');
            document.getElementById('p-preview').classList.add('d-none');
            fotoPreview.classList.remove('d-none')
        };
    </script>
    <script>
        let nav_link_news = document.querySelector('#nav-link-news')
        nav_link_news.setAttribute("href", '<?= $BASE_URL ?>editor/news')
        nav_link_news.classList.add('active')

        document.querySelector('#nav-link-chart').setAttribute('href', '<?= $BASE_URL ?>editor/chart')

        document.getElementById("submit").onclick = function(e) {
            if (document.getElementById("foto").value == "") {
                document.getElementById("form-input-border").classList.add('border-danger');
            }
        }
    </script>
</body>

</html>
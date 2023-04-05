<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/query.php');
include('../../../app/functions/slug_maker.php');
include('../../../app/functions/upload_file.php');
include('../../../app/functions/authority_check.php');
include('../../../app/functions/fullname_check.php');

echo authority_check() !== "user" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$artis = "";
$judul_lagu = "";
$tanggal_rilis = "";
$file = '';

$success = false;

if (isset($_POST['submit'])) {
    $artis = $_POST['artis'];
    $judul_lagu = $_POST['judul-lagu'];
    $tanggal_rilis = $_POST['tanggal-rilis'];
    $file = uploadFile($_FILES['file'], '../../../app/data/file/press-release/');
    $slug = slug_maker($artis . '-' . $judul_lagu, 'td_surat_masuk');

    mysqli_query($conn, "INSERT INTO td_surat_masuk VALUES ('', '$artis', '$judul_lagu', '$slug', '$tanggal_rilis', 'press release', '$file')");

    $success = true;
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

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-5 fw-semibold" id="modalLabel">Berhasil</p>
                        <a href="<?= $BASE_URL ?>user/support" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        Permohonan Press Release Anda berhasil dikirimkan
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" href="<?= $BASE_URL ?>user/support">Oke</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="container mb-5 py-5">
            <div class="row mt-5 mb-4">
                <div class="col my-5">
                    <div class="d-flex">
                        <h1 class="mx-auto border-dark border-bottom border-4 bigger-heading text-shadow-sm">Press Release</h1>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col">

                        <div class="card rounded-5 shadow">
                            <div class="card-body p-lg-5 m-4">

                                <div class="mb-5">
                                    <p class="fs-3 fw-semibold">Syarat dan Ketentuan Format Surat</p>
                                    <ul class="fs-5">
                                        <li>Membuat Surat Permohonan Press Release dengan Judul Perihal "Surat Permohonan Press Release"</li>
                                        <li>Tujuan Surat ditujukan kepada "Station Manager UKM RK EBS FM UNHAS"</li>
                                        <li>Isi Surat menjelaskan perihal lagu yang akan dipromosikan</li>
                                        <li>Menambahkan lampiran link Google Drive berisi Foto Musisi dan Audio Lagu / Video Clip Lagu</li>
                                        <li>Format Surat .DOCX / .PDF</li>
                                    </ul>
                                </div>

                                <div class="mb-5">
                                    <label for="artis" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Artis <span class="text-danger">*</span></p>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="artis" name="artis" placeholder="Enter text" value="<?= $artis ?>" required>
                                </div>

                                <div class="mb-5">
                                    <label for="judul-lagu" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Judul Lagu <span class="text-danger">*</span></p>
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="judul-lagu" name="judul-lagu" placeholder="Enter text" value="<?= $judul_lagu ?>" required>
                                </div>


                                <div class="mb-5">
                                    <label for="tanggal-rilis" class="form-label">
                                        <p class="fs-3 text-muted mb-1">Tanggal Rilis <span class="text-danger">*</span></p>
                                    </label>
                                    <input type="date" class="form-control form-control-lg" id="tanggal-rilis" name="tanggal-rilis" placeholder="Enter text" value="<?= $tanggal_rilis ?>" required>
                                </div>

                                <div class="mb-5">
                                    <div id="form-input-border" class="card border border-1 w-100 cursor-pointer">
                                        <div class="card-body cursor-pointer">
                                            <label for="file" class="w-100 cursor-pointer">
                                                <p id="p-preview" class="text-center mb-0 py-5"><i class="bi bi-upload"></i>&ensp;Upload Additional File <span class="text-danger">*</span></p>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="text-muted small">Attach file.File size of your document should not exceed 10 MB</p>
                                    <input class="d-none" type="file" onchange="loadFile(event)" name="file" id="file" accept=".docx, .pdf" required>
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
        let nav_link_support = document.querySelector('#nav-link-support')
        nav_link_support.classList.add('active')

        var form_input_border = document.getElementById('form-input-border');

        document.getElementById("submit").onclick = function(e) {
            if (document.getElementById("file").value == "") {
                form_input_border.classList.add('border-danger');
            }
        }

        var loadFile = function(event) {
            form_input_border.classList.remove('border-danger');
            document.getElementById('p-preview').innerHTML = '<h1><i class="bi bi-file-earmark-text-fill"></i></h1>' + document.getElementById('file').files[0].name;
        };
    </script>

    <?php if ($success) : ?>
        <script>
            const modal = new bootstrap.Modal(document.getElementById('modal'));
            modal.show();
        </script>
    <?php endif ?>
</body>

</html>
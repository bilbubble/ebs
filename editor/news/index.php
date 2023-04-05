<?php

session_start();

include('../../app/functions/base_url.php');
include('../../app/functions/db_connect.php');
include('../../app/functions/query.php');
include('../../app/functions/authority_check.php');
include('../../app/functions/fullname_check.php');
include('../../app/functions/date_formatter.php');

echo authority_check() !== "editor" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$result_news = query("SELECT * FROM td_news WHERE rubrik <> 'EBS Music Box' ORDER BY id DESC LIMIT 10");
$result_music_box = query("SELECT * FROM td_news WHERE rubrik = 'EBS Music Box' ORDER BY id DESC LIMIT 10");

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


        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-5 fw-semibold" id="modalLabel">Are You Sure ?</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btn-delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="container my-5 pt-5 pb-4">
            <div class="row mt-5 mb-4 justify-content-center">
                <div class="col mt-5 mb-4">
                    <div class="d-flex flex-wrap align-items-center">
                        <h1 class="border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg me-5">EBS NEWS&ensp;&ensp;</h1>
                        <a href="<?= $BASE_URL ?>editor/news/add" class="btn btn-success ms-md-auto btn-lg rounded-4"><i class="bi bi-plus-lg"></i>&ensp;Add More</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col">
                    <div class="card rounded-5 shadow py-4 px-lg-5">
                        <div class="card-body">
                            <?php if (isset($result_news[0])) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="w-100 bg-size-cover" style="background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_news[0]['foto'] ?>');">
                                            <div class="bg-dark p-4 w-100 bg-opacity-50 d-flex flex-column align-items-start justify-content-evenly" style="height:75vh">
                                                <?php if ($result_news[0]['rubrik']) : ?>
                                                    <a href="#" class="btn btn-info btn-sm rounded-0"><?= $result_news[0]['rubrik'] ?></a>
                                                <?php endif ?>
                                                <p class="fs-3 text-white fw-bolder mt-auto"><?= $result_news[0]['judul'] ?></p>
                                                <div class="col-6 col-md-3 col-lg-2 bg-danger mt-5 mb-3" style="height: 2px;"></div>
                                                <p class="fs-3 text-white truncate-2-line"><?= $result_news[0]['konten'] ?></p>
                                                <div class="ms-auto">
                                                    <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_news[0]['slug'] ?>" class="btn btn-primary px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_news[0]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="row pt-3 pt-lg-0">
                                <?php for ($i = 1; $i < 4; $i++) : ?>
                                    <?php if (isset($result_news[$i])) : ?>
                                        <div class="col-lg-4 my-4">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="bg-size-cover w-100 p-2" style="height: 120px; background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_news[$i]['foto'] ?>')">
                                                        <a href="#" class="btn btn-sm btn-info bg-info rounded-0 px-1 py-0 border-0"><span class="very-small"><?= $result_news[$i]['rubrik'] ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-7">
                                                    <p class="small mb-0 mt-1 mt-md-0"><?= $result_news[$i]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_news[$i]['tgl_terbit'], "dd mmm yyyy") ?></span></p>
                                                    <p class="fs-6 fw-semibold truncate-2-line"><?= $result_news[$i]['judul'] ?></p>
                                                    <div>
                                                        <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_news[$i]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_news[$i]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endfor ?>
                            </div>

                            <div class="row my-5 my-lg-4">
                                <div class="col-3 col-lg-2 bg-danger" style="height: 1px;"></div>
                                <div class="col-9 col-lg-10 bg-dark" style="height: 1px;"></div>
                            </div>

                            <div class="row">
                                <?php if (isset($result_news[4])) : ?>
                                    <div class="col-lg-6 mt-3">
                                        <div class="w-100 bg-size-cover" style="background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_news[4]['foto'] ?>');">
                                            <div class="p-4 w-100" style="height:45vh">
                                                <a href="#" class="btn btn-success btn-sm rounded-0 mb-auto"><?= $result_news[4]['rubrik'] ?></a>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <p class="small mb-0 my-3 me-auto"><?= $result_news[4]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_news[4]['tgl_terbit'], 'dd mmm yyyy') ?></span></p>
                                            <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_news[4]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 my-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_news[4]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0 my-3">Delete</button>
                                        </div>

                                        <p class="fs-5 fw-semibold truncate-2-line mb-3"><?= $result_news[4]['judul'] ?></p>
                                        <p class="fs-6 truncate-2-line my-5 pb-5 text-muted"><?= $result_news[4]['konten'] ?></p>
                                    </div>
                                <?php endif ?>


                                <div class="col-lg-6">
                                    <?php for ($i = 5; $i < 10; $i++) : ?>
                                        <?php if (isset($result_news[$i])) : ?>
                                            <div class="row my-3">
                                                <div class="col-lg-5 col-xl-4">
                                                    <div class="bg-size-cover w-100 p-2" style="height: 120px; background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_news[$i]['foto'] ?>')">
                                                        <a href="#" class="btn btn-sm btn-info bg-info rounded-0 px-1 py-0 border-0"><span class="very-small"><?= $result_news[$i]['rubrik'] ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-xl-8">
                                                    <p class="small mb-0 mt-1 mt-md-0"><?= $result_news[$i]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_news[$i]['tgl_terbit'], "dd mmm yyyy") ?></span></p>
                                                    <p class="fs-6 fw-semibold truncate-2-line"><?= $result_news[$i]['judul'] ?></p>
                                                    <div>
                                                        <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_news[$i]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_news[$i]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endfor ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="container my-5 pb-4">
            <div class="row mt-5 mb-4 justify-content-center">
                <div class="col mt-5 mb-4">
                    <div class="d-flex flex-wrap align-items-center">
                        <h1 class="border-dark border-bottom border-4 outlined-heading bigger-heading text-shadow-lg me-5">EBS MUSIC BOX&ensp;&ensp;</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col">
                    <div class="card rounded-5 shadow py-4 px-lg-5">
                        <div class="card-body">
                            <?php if (isset($result_music_box[0])) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="w-100 bg-size-cover" style="background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_music_box[0]['foto'] ?>');">
                                            <div class="bg-dark p-4 w-100 bg-opacity-50 d-flex flex-column align-items-start justify-content-evenly" style="height:75vh">
                                                <?php if ($result_music_box[0]['rubrik']) : ?>
                                                    <a href="#" class="btn btn-primary btn-sm rounded-0"><?= $result_music_box[0]['rubrik'] ?></a>
                                                <?php endif ?>
                                                <p class="fs-3 text-white fw-bolder mt-auto"><?= $result_music_box[0]['judul'] ?></p>
                                                <div class="col-6 col-md-3 col-lg-2 bg-danger mt-5 mb-3" style="height: 2px;"></div>
                                                <p class="fs-3 text-white truncate-2-line"><?= $result_music_box[0]['konten'] ?></p>
                                                <div class="ms-auto">
                                                    <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_music_box[0]['slug'] ?>" class="btn btn-primary px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_music_box[0]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="row pt-3 pt-lg-0">
                                <?php for ($i = 1; $i < 4; $i++) : ?>
                                    <?php if (isset($result_music_box[$i])) : ?>
                                        <div class="col-lg-4 my-4">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="bg-size-cover w-100 p-2" style="height: 120px; background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_music_box[$i]['foto'] ?>')">
                                                        <a href="#" class="btn btn-sm btn-info bg-info rounded-0 px-1 py-0 border-0"><span class="very-small"><?= $result_music_box[$i]['rubrik'] ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-7">
                                                    <p class="small mb-0 mt-1 mt-md-0"><?= $result_music_box[$i]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_music_box[$i]['tgl_terbit'], "dd mmm yyyy") ?></span></p>
                                                    <p class="fs-6 fw-semibold truncate-2-line"><?= $result_music_box[$i]['judul'] ?></p>
                                                    <div>
                                                        <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_music_box[$i]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_music_box[$i]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endfor ?>
                            </div>

                            <div class="row my-5 my-lg-4">
                                <div class="col-3 col-lg-2 bg-danger" style="height: 1px;"></div>
                                <div class="col-9 col-lg-10 bg-dark" style="height: 1px;"></div>
                            </div>

                            <div class="row">
                                <?php if (isset($result_music_box[4])) : ?>
                                    <div class="col-lg-6 mt-3">
                                        <div class="w-100 bg-size-cover" style="background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_music_box[4]['foto'] ?>');">
                                            <div class="p-4 w-100" style="height:45vh">
                                                <a href="#" class="btn btn-success btn-sm rounded-0 mb-auto"><?= $result_music_box[4]['rubrik'] ?></a>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <p class="small mb-0 my-3 me-auto"><?= $result_music_box[4]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_music_box[4]['tgl_terbit'], 'dd mmm yyyy') ?></span></p>
                                            <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_music_box[4]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 my-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_music_box[4]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0 my-3">Delete</button>
                                        </div>

                                        <p class="fs-5 fw-semibold truncate-2-line mb-3"><?= $result_music_box[4]['judul'] ?></p>
                                        <p class="fs-6 truncate-2-line my-5 pb-5 text-muted"><?= $result_music_box[4]['konten'] ?></p>
                                    </div>
                                <?php endif ?>

                                <div class="col-lg-6">
                                    <?php for ($i = 5; $i < 10; $i++) : ?>
                                        <?php if (isset($result_music_box[$i])) : ?>
                                            <div class="row my-3">
                                                <div class="col-lg-5 col-xl-4">
                                                    <div class="bg-size-cover w-100 p-2" style="height: 120px; background-image: url('<?= $BASE_URL ?>app/data/img/foto-berita/<?= $result_music_box[$i]['foto'] ?>')">
                                                        <a href="#" class="btn btn-sm btn-info bg-info rounded-0 px-1 py-0 border-0"><span class="very-small"><?= $result_music_box[$i]['rubrik'] ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-xl-8">
                                                    <p class="small mb-0 mt-1 mt-md-0"><?= $result_music_box[$i]['penulis'] ?><span class="text-muted"> - <?= date_formatter($result_music_box[$i]['tgl_terbit'], "dd mmm yyyy") ?></span></p>
                                                    <p class="fs-6 fw-semibold truncate-2-line"><?= $result_music_box[$i]['judul'] ?></p>
                                                    <div>
                                                        <a href="<?= $BASE_URL ?>editor/news/edit?id=<?= $result_music_box[$i]['slug'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm"><i class="bi bi-vector-pen"></i>&nbsp;Edit</a>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal" onclick="setDelete('<?= $result_music_box[$i]['id'] ?>')" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endfor ?>

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
        let nav_link_news = document.querySelector('#nav-link-news')
        nav_link_news.setAttribute("href", '<?= $BASE_URL ?>editor/news')
        nav_link_news.classList.add('active')

        document.querySelector('#nav-link-chart').setAttribute('href', '<?= $BASE_URL ?>editor/chart')

        function setDelete($id) {
            document.getElementById('btn-delete').setAttribute('onclick', 'window.location.replace("<?= $BASE_URL ?>editor/news/delete?id=' + $id + '")')
        }
    </script>
</body>

</html>
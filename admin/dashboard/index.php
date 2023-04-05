<?php

session_start();

include('../../app/functions/base_url.php');
include('../../app/functions/db_connect.php');
include('../../app/functions/query.php');
include('../../app/functions/date_formatter.php');
include('../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$results = query("SELECT * FROM td_surat_masuk ORDER BY id DESC LIMIT 5");

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
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <div class="bg-size-cover rounded-4" style="background-image: url('https://i.natgeofe.com/k/830b5d15-92db-429f-a80a-cc89b5700af5/mt-everest.jpg?w=636&h=437');">
            <div class="bg-primary p-4 bg-opacity-75 rounded-4 pb-5" style="min-height: 20vw;">
              <div class="d-flex">
                <div class="div">
                  <p class="text-white fw-normal mb-0"><span class="opacity-50">Pages</span> / Dashboard</p>
                  <p class="fs-5 text-white fw-semibold mb-5">Dashboard</p>
                </div>
                <div class="ms-auto">
                  <div class="dropdown">
                    <a class="dropdown-toggle fw-semibold text-white text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-person-circle"></i>&ensp;Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="<?= $BASE_URL ?>admin/account-pages/kelola-akun/edit?username=<?= $_SESSION['login'] ?>">Settings</a></li>
                      <li><a class="dropdown-item text-danger" href="#" onclick="window.location.replace('<?= $BASE_URL ?>app/functions/log_out.php')">Log Out</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mx-1 mx-lg-3" style="margin-top: -12vh;">
          <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card rounded-4 shadow border-0">
              <div class="card-body p-1">
                <div class="d-flex align-items-center">
                  <img class="rounded-4 object-fit-cover" src="https://storyblok-image.ef.com/unsafe/1500x750/filters:focal(792x290:793x291):quality(90)/f/78828/1920x750/10f113c696/ef_blog_header_beda_people.jpg" alt="" style="width: 100px; height:100px;">
                  <div class="ms-3">
                    <p class="mb-0 fw-bold fs-6">Trisakti Akbar</p>
                    <p class="mb-0 text-muted">Admin</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mx-1 mx-lg-3 mt-4">
          <div class="col-xl-8 col-lg-6">
            <div class="card rounded-4 shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-xl-5 order-xl-last pb-3 pb-xl-0">
                    <img src="<?= $BASE_URL ?>img/rocket.png" alt="" class="rounded-4 w-100">
                  </div>

                  <div class="col-xl-7">
                    <div class="d-flex align-items-start flex-column mb-3">
                      <div class="pt-2 px-2 fw-bold text-muted mt-auto">Surat Masuk</div>
                      <p class="px-2 fs-5 fw-bolder">Media Partner</p>
                      <div class="mb-auto px-2 text-muted">Media partner adalah kerjasama yang terjalin antara penyelenggara event dengan EBS FM UNHAS. Untuk lebih jelasnya, klik link di bawah ini !</div>
                      <a class="btn btn-outline-pink rounded-pill px-5 mt-3 ms-auto px-lg-4 ms-lg-0" href="<?= $BASE_URL ?>admin/media-partner"><i class="bi bi-arrow-right-circle"></i>&ensp;Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card rounded-4 shadow border-0 mt-4 mb-5">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-xl-5 order-xl-last pb-3 pb-xl-0">
                    <img src="<?= $BASE_URL ?>img/rocket.png" alt="" class="rounded-4 w-100">
                  </div>

                  <div class="col-xl-7">
                    <div class="d-flex align-items-start flex-column mb-3">
                      <div class="pt-2 px-2 fw-bold text-muted mt-auto">Surat Masuk</div>
                      <p class="px-2 fs-5 fw-bolder">Press Release</p>
                      <div class="mb-auto px-2 text-muted">Press Release adalah bentuk kerja sama dimana EBS FM UNHAS melakukan promosi mengenai lagu terbaru, dan musisi terbaru yang diajukan oleh pihak pemohon. Untuk lebih jelasnya, silahkan klik tombol detail di bawah !</div>
                      <a class="btn btn-outline-pink rounded-pill px-5 mt-3 ms-auto px-lg-4 ms-lg-0" href="<?= $BASE_URL ?>admin/press-release"><i class="bi bi-arrow-right-circle"></i>&ensp;Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6">
            <div class="card shadow-lg border-0 mt-5">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <p class="fw-bold me-auto mb-0">Terbaru</p>
                  <a href="<?= $BASE_URL ?>admin/media-partner" class="btn btn-sm p-2 px-lg-4 btn-outline-pink">VIEW ALL</a>
                </div>

                <table class="table align-middle mt-2">
                  <tbody>
                    <?php foreach ($results as $result) : ?>
                      <tr>
                        <td class="border-0 pt-3 cursor-pointer" onclick="window.location.href = '<?= $BASE_URL ?>admin/<?= $result['jenis'] === 'media partner' ? 'media-partner' : 'press-release' ?>/edit?id=<?= $result['slug'] ?>'">
                          <p class="mb-0 fw-semibold"><?= date_formatter($result['tanggal'], "mmmm dd, yyyy") ?></p>
                          <p class="text-muted mb-0 small"><?= $result['jenis'] ?></p>
                        </td>
                        <td class="border-0 pt-3 cursor-pointer" onclick="window.location.href = '<?= $BASE_URL ?>admin/<?= $result['jenis'] === 'media partner' ? 'media-partner' : 'press-release' ?>/edit?id=<?= $result['slug'] ?>'">
                          <p class="mb-0 text-center"><?= $result['nama'] ?></p>
                        </td>
                        <th scope="row" class="border-0 text-center pt-3">
                          <?php if ($result['jenis'] == "media partner") : ?>
                            <a href="<?= $BASE_URL ?>app/data/file/media-partner/<?= $result['file'] ?>" download="<?= $result['nama'] . ' - ' . $result['judul'] ?>" class="text-decoration-none text-dark mb-0">PDF</a>
                          <?php else : ?>
                            <a href="<?= $BASE_URL ?>app/data/file/press-release/<?= $result['file'] ?>" download="<?= $result['nama'] . ' - ' . $result['judul'] ?>" class="text-decoration-none text-dark mb-0">PDF</a>
                          <?php endif ?>
                        </th>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>


  <script src="<?= $BASE_URL ?>js/script.js"></script>
  <script>
    document.getElementById('icon-dashboard').classList.add('bg-primary', 'text-white');
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>
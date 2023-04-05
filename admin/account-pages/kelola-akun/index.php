<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/query.php');
include('../../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$results = query("SELECT * FROM td_account ORDER BY fullname");

$fullname = "";
$email = "";
$username = "";
$password = "";
$confirm_password = "";
$status = "user";
$error = false;

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    if ($password !== $confirm_password) {
        $error = "Konfirmasi password salah";
    } else {
        $username = strtolower($username);
        $username = str_replace('@', '', $username);
        $password_hash = mysqli_real_escape_string($conn, $password);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Cek Username Exist
        $result = mysqli_query($conn, "SELECT username FROM td_account WHERE username='$username'");

        if (mysqli_fetch_assoc($result)) {
            $error = "Username telah terdaftar di sistem... Silahkan gunakan username yang lain";
        } else {
            mysqli_query(
                $conn,
                "INSERT INTO td_account VALUES (
                    '',
                    '$fullname',
                    '$email',
                    '$username',
                    '$password_hash',
                    '$status',
                    ''
                    )"
            );

            header("Refresh: 0");
        }
    }
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
                        <p class=" fw-normal mb-0"><span class="opacity-50">Account Pages</span> / Kelola Akun</p>
                        <p class="fs-3 fw-semibold">Kelola Akun</p>
                    </div>

                    <p class="mt-3 fs-5 mb-1">Tambah Akun</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddAccount" class="btn btn-success btn-lg mb-4 shadow-sm">Add Account</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAddAccount" tabindex="-1" aria-labelledby="modalAddAccountLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title fs-5 fw-semibold" id="modalAddAccountLabel">Add New Account</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <?php if ($error) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <p class="mb-1 fs-6 fw-bold">Sign Up Failed</p>
                                                <p class="mb-0"><?= $error ?></p>
                                            </div>
                                        <?php endif ?>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="<?= $fullname ?>">
                                            <label for="fullname">Full Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $username ?>">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $password ?>">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Password" value="<?= $confirm_password ?>">
                                            <label for="confirm-password">Confirm Password</label>
                                        </div>
                                        <div class="form-floating">
                                            <select class="form-select" id="status" name="status" aria-label="Status">
                                                <option value="user">User</option>
                                                <option value="editor">Editor</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="card border-0 shadow-0">
                                <div class="card-body">

                                    <table class="table text-center mx-lg-3">
                                        <thead>
                                            <tr class="fw-bold">
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3 text-start">Account</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Status</th>
                                                <th scope="col" class="border-0 fs-6 pt-4 pb-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $result) : ?>
                                                <tr class="text-muted fw-semibold align-middle">
                                                    <td class="border-0 fs-6 py-3 text-start">
                                                        <p class="mb-0 fw-bold text-dark"><?= $result['fullname'] ?></p>
                                                        <p class="text-muted"><?= $result['email'] ?></p>
                                                    </td>
                                                    <td class="border-0 fs-6 py-3"><?= $result['otoritas'] ?></td>
                                                    <td class="border-0 fs-6 py-3">
                                                        <a href="<?= $BASE_URL ?>admin/account-pages/kelola-akun/edit?username=<?= $result['username'] ?>" class="btn btn-outline-primary bg-primary bg-opacity-25 border-0 px-lg-3 rounded-pill btn-sm my-1 text-purple">Edit</a>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal<?= $result['id'] ?>" class="btn btn-danger px-lg-3 rounded-pill btn-sm  border-0 my-1"><i class="bi bi-vector-pen"></i>&nbsp;Delete</button>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal<?= $result['id'] ?>" tabindex="-1" aria-labelledby="modal<?= $result['id'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p class="modal-title fs-5 fw-semibold" id="modal<?= $result['id'] ?>Label">Yakin Ingin Menghapus Pengguna</p>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus <b><?= $result['fullname'] ?></b> ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="button" class="btn btn-primary" onclick="window.location.replace('<?= $BASE_URL ?>admin/account-pages/kelola-akun/delete?username=<?= $result['username'] ?>')">Hapus Pengguna</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        document.getElementById('icon-kelola-akun').classList.add('bg-primary', 'text-white');
    </script>

    <?php if ($error) : ?>
        <script>
            const modal = new bootstrap.Modal(document.getElementById('modalAddAccount'));
            modal.show();
        </script>
    <?php endif ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>
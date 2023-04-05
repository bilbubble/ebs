<?php

session_start();

include('../../../../app/functions/base_url.php');
include('../../../../app/functions/db_connect.php');
include('../../../../app/functions/query.php');
include('../../../../app/functions/date_formatter.php');
include('../../../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";


$username = $_GET['username'];
$error = false;

$result = query("SELECT * FROM td_account WHERE username = '$username' LIMIT 1")[0];

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE td_account SET fullname = '$fullname', email = '$email' WHERE username = '$username'");
    header("Refresh: 0");
}

if (isset($_POST['reset-password'])) {
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    if ($new_password === $confirm_password) {
        $new_password = mysqli_real_escape_string($conn, $new_password);
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);

        mysqli_query($conn, "UPDATE td_account SET password = '$new_password' WHERE username = '$username'");
    } else {
        $error = "Konfirmasi Password Salah";
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

            <?php include('../../../sidebar/sidebar.php') ?>

            <?php include('../../../navbar/navbar.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Sign Up Failed</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?= $error ? $error : "" ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div class="bg-opacity-75 rounded-4 my-3">
                        <p class=" fw-normal mb-0"><span class="opacity-50">Account Pages / Kelola Akun</span> / <?= $result['fullname'] ?></p>
                        <p class="fs-3 fw-semibold">Kelola Akun</p>
                    </div>

                    <div class="row justify-content-center mb-5 pb-3">
                        <div class="col">
                            <div class="card border-0">
                                <div class="card-body p-lg-5">

                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <p class="accordion-header" id="headingOne">
                                                <button class="accordion-button text-dark fw-semibold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Account
                                                </button>
                                            </p>
                                            <form action="" method="post">
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="my-4">
                                                            <label for="fullname" class="form-label">
                                                                <p class="text-muted mb-1">Full Name</p>
                                                            </label>
                                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter text" value="<?= $result['fullname'] ?>" required>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="email" class="form-label">
                                                                <p class="text-muted mb-1">Email</p>
                                                            </label>
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter text" value="<?= $result['email'] ?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">
                                                                <p class="text-muted mb-1">Username</p>
                                                            </label>
                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter text" value="<?= $result['username'] ?>" disabled required>
                                                        </div>

                                                        <div class="d-flex mb-5">
                                                            <button type="submit" class="btn btn-success btn-lg px-5 mt-3 mx-auto rounded-0" id="submit" name="submit">
                                                                <div class="px-5">Save Changes</div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="accordion-item">
                                            <p class="accordion-header" id="headingTwo">
                                                <button class="accordion-button text-dark fw-semibold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Reset Password
                                                </button>
                                            </p>
                                            <form action="" method="post">
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="my-4">
                                                            <label for="new-password" class="form-label">
                                                                <p class="text-muted mb-1">New Password</p>
                                                            </label>
                                                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter text" required minlength="8">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="confirm-password" class="form-label">
                                                                <p class="text-muted mb-1">Confirm Password</p>
                                                            </label>
                                                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Enter text" required minlength="8">
                                                        </div>

                                                        <div class="d-flex mb-5">
                                                            <button type="submit" class="btn btn-success btn-lg px-5 mt-3 mx-auto rounded-0" id="reset-password" name="reset-password">
                                                                <div class="px-5">Save Changes</div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        </script>
    <?php endif ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>
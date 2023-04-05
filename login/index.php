<?php

session_start();

include('../app/functions/base_url.php');
include('../app/functions/db_connect.php');
include('../app/functions/query.php');
include('../app/functions/authority_check.php');
include('../app/functions/fullname_check.php');

echo authority_check() !== "guest" ? (authority_check() === 'admin' ? "<script>window.location.replace('$BASE_URL/admin/dashboard')</script>" : "<script>window.location.replace('$BASE_URL/editor/news')</script>") : "";


$username = "";
$password = "";
$error = false;

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM td_account WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            $_SESSION['login'] = $username;

            if ($row['otoritas'] === 'user') {
                header("Location: $BASE_URL");
            } else if ($row['otoritas'] === 'editor') {
                header("Location: " . $BASE_URL . "editor/news");
            } else {
                header("Location: " . $BASE_URL . "admin/dashboard");
            }
            exit;
        } else {
            $error = "Password tidak valid";
        }
    } else {
        $error = "Akun anda tidak terdaftar di sistem";
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

<body>

    <?php include('../nav/navbar.php') ?>

    <main class="pt-5">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Login Failed</p>
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

        <section class="container">
            <div class="row align-items-center" style="height: 100vh;">

                <div class="d-none d-lg-block col-lg-6">
                    <img src="<?= $BASE_URL ?>img/bg-login.png" alt="" class="img-fluid overflow-y-hidden" style="height: 60vh;">
                </div>
                <div class="col-lg-6 mt-5 mb-4">
                    <p class="d-inline text-shadow-sm fs-2 fw-bold">Welcome to</p>
                    <h1 class="bigger-heading text-purple text-shadow-purple-sm mb-5">EBS FM UNHAS</h1>

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-2" id="username" name="username" placeholder="Username">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control rounded-2" id="password" name="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary w-100 mt-4 mb-3 py-2">Login</button>
                        <p class="text-center fw-semibold">Don't have an account? <a href="<?= $BASE_URL ?>sign-up" class="text-primary text-decoration-none">Sign up</a></p>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <script src="<?= $BASE_URL ?>js/script.js"></script>

    <?php if ($error) : ?>
        <script>
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        </script>
    <?php endif ?>
</body>

</html>
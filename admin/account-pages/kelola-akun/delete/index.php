<?php

session_start();

include('../../../../app/functions/base_url.php');
include('../../../../app/functions/db_connect.php');
include('../../../../app/functions/query.php');
include('../../../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$username = $_GET['username'];

mysqli_query($conn, "DELETE FROM td_account WHERE username = '$username'");

echo "<script>window.location.replace('" . $BASE_URL . "admin/account-pages/kelola-akun')</script>";

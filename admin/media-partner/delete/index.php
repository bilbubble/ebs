<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/authority_check.php');

echo authority_check() !== "admin" ? "<script>window.location.replace('$BASE_URL')</script>" : "";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM td_surat_masuk WHERE id = '$id'");

echo "<script>window.location.replace('" . $BASE_URL . "admin/media-partner')</script>";

<?php

session_start();

include('../../../app/functions/base_url.php');
include('../../../app/functions/db_connect.php');
include('../../../app/functions/authority_check.php');

echo authority_check() !== "editor" ? "<script>window.location.replace('$BASE_URL')</script>" : "";


$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM td_chart WHERE id = '$id'");

echo "<script>window.location.replace('" . $BASE_URL . "editor/chart')</script>";

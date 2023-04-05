<?php

include('base_url.php');

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time() - 3600, $BASE_URL . 'login');
setcookie('key', '', time() - 3600, $BASE_URL . 'login');

header("Location: " . $BASE_URL . "login");

exit;

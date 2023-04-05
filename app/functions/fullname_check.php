<?php

function fullname_check()
{
    global $conn;
    $username = $_SESSION['login'];
    $fullname = query("SELECT * FROM td_account WHERE username = '$username' LIMIT 1")[0]['fullname'];
    return $fullname;
}

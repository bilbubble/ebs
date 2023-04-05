<?php

function authority_check()
{
    global $conn;
    if (isset($_SESSION['login'])) {
        $username = $_SESSION['login'];

        // Cek Username Exist
        $result = mysqli_query($conn, "SELECT * FROM td_account WHERE username='$username' LIMIT 1");

        if (mysqli_fetch_assoc($result)) {
            $result = query("SELECT * FROM td_account WHERE username = '$username' LIMIT 1")[0];
            $authority = $result['otoritas'];
        } else {
            $authority = 'guest';
        }
    } else {
        $authority = 'guest';
    }
    return $authority;
}

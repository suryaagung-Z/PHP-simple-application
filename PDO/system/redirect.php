<?php
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === "on")) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/toskul/';
} else {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/toskul/';;
}

$redirectUser  = $url . 'user';
$redirectAdmin = $url . 'admin';
$redirectLogin = $url . 'login.php';

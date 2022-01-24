<?php
session_start();
require('redirect.php');
if (!isset($_SESSION['idUser'])) {
    echo "<script>alert('Login Terlebih Dahulu!'); window.location.replace('" . $redirectLogin . "');</script>";
    die();
}

require('function.php');
logout();

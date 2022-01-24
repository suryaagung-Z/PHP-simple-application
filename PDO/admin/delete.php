<?php
session_start();
require('../system/redirect.php');
if (!isset($_SESSION['idUser'])) {
    echo "<script>alert('Login Terlebih Dahulu!'); window.location.replace('" . $redirectLogin . "');</script>";
    die();
}

require('../system/function.php');

$id = $_GET['id'];
dataDelete($id);

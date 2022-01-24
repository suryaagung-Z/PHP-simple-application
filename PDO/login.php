<?php
session_start();
require('system/redirect.php');
if (isset($_SESSION['idUser'])) {
    echo "<script>alert('Logout Terlebih Dahulu!'); window.location.replace('" . $redirectAdmin . "');</script>";
    die();
}

require('system/function.php');

if (isset($_POST['submit'])) {
    login($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link rel="stylesheet" href="css/indexUser.css">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <a href="user/index.php" class="link">tambah data</a>

    <p class="head">Login Admin</p>

    <form action="" method="POST">
        <div class="box">
            <label for="username">Nama pengguna / Email :</label>
            <input type="text" name="username" id="username" autocomplete="off" required>
        </div>

        <div class="box">
            <label for="pass">Kata Sandi :</label>
            <input type="password" name="pass" id="pass" autocomplete="off" required>
        </div>

        <div class="box">
            <button type="submit" name="submit">login</button>
        </div>
    </form>

</body>

</html>
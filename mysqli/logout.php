<?php
    session_start();

    session_destroy();

    setcookie('login', '', 0);

    header("location: login.php");
    die;
?>
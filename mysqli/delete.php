<?php
    require('function.php');

    $id = $_GET["id"];
    $foto = $_GET["foto"];

    if( delete($id, $foto) > 0 ){
        header("location: index.php");
    }else{
        header("location: index.php");
    }
?>
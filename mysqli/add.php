<?php
    session_start();
    if( !isset($_SESSION["login"]) ){
        header("location: login.php");
        die;
    }
    require('function.php');

    if( isset($_POST["submit"]) ){

        add($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data</title>

    <style>
        *{
            box-sizing: border-box;
        }
        body{
            margin: 0;
            font-family: sans-serif;
        }
        form{
            width: 600px;
            margin: 50px auto;
        }
        fieldset{
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        legend{
            font-size: 30px;
        }
        [type="submit"]{
            width: 100px; 
        }
        #back{
            padding: 10px;
            margin: 20px;
            float: left;
            background: blue;
            text-decoration: none;
            color: #fff;
        }
        .both{
            clear: both;
        }

    </style>
</head>
<body>
    <a href="index.php" id="back">kembali</a>
    <div class="both"></div>

    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Tambah data</legend>

            <label for="forKls">Kelas :</label>
            <select name="kelas" id="forKls" required>
                <option value="" disabled selected>select</option>
                <option value="X">10</option>
                <option value="XI">11</option>
                <option value="XII">12</option>
            </select><br>

            <label for="forJurusan">Jurusan :</label>
            <select name="jurusan" id="forJurusan" required>
                <option value="" disabled selected>select</option>
                <option value="RPL">RPL</option>
                <option value="TKJ">TKJ</option>
                <option value="MM">MM</option>
            </select><br>

            <label for="forNama">Nama :</label>
            <input type="text" name="nama" id="forNama" autocomplete="off" required><br>

            <label for="forEmail">Email :</label>
            <input type="text" name="email" id="forEmail" autocomplete="off" required><br>

            <label for="forFoto">Upload foto :</label>
            <input type="file" name="foto" id="forFoto" required accept=".jpg, .png, .jpeg"><br>

            <button type="submit" name="submit">tambah</button>
        </fieldset>
    </form>
    
</body>
</html>
<?php
    session_start();
    if( !isset($_SESSION["login"]) ){
        header("location: login.php");
        die;
    }
    require('function.php');

    $id = $_GET["id"];

    $tables = read("SELECT * FROM one WHERE id = $id")[0];
    $foto = $tables["foto"];

    if( isset($_POST["submit"]) ){

        if( update($_POST, $id, $foto) > 0){
            header("location:index.php");
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>

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
        img{
            width: 50px;
        }
        fieldset{
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        legend{
            font-size: 30px;
        }

        #submit{
            color: white;
            background-color: blue;
            width: 100px;
        }
        a{
            text-decoration: none;
            color: #fff;
        }
        #back{
            padding: 10px;
            margin: 20px;
            float: left;
            background: blue;
        }
        #cancel{
            width: 100px;
            padding: 5px 0;
            text-align: center;
            background: red;
            font-size: 13px;
            margin: 10px 0;
            cursor: default;
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
            <legend>Ubah data</legend>

            <label for="forKls">Kelas :</label>
            <select name="kelas" id="forKls" required>
                <?php if( $tables["kls"] == "X" ) { ?>
                    <option value="X" selected>10</option>
                    <option value="XI">11</option>
                    <option value="XII">12</option>
                <?php } else if($tables["kls"] == "XI") {?>
                    <option value="X">10</option>
                    <option value="XI" selected>11</option>
                    <option value="XII">12</option>
                <?php } else{?>
                    <option value="X">10</option>
                    <option value="XI">11</option>
                    <option value="XII" selected>12</option>
                <?php } ?>
            </select><br>

            <label for="forJurusan">Jurusan :</label>
            <select name="jurusan" id="forJurusan" required>
                <?php if( $tables["jurusan"] == "MM" ) { ?>
                    <option value="MM" selected>MM</option>
                    <option value="TKJ">TKJ</option>
                    <option value="RPL">RPL</option>
                <?php } else if($tables["jurusan"] == "RPL") {?>
                    <option value="MM">MM</option>
                    <option value="TKJ">TKJ</option>
                    <option value="RPL" selected>RPL</option>
                <?php } else{?>
                    <option value="MM">MM</option>
                    <option value="TKJ" selected>TKJ</option>
                    <option value="RPL">RPL</option>
                <?php } ?>
            </select><br>

            <label for="forNama">Nama :</label>
            <input type="text" name="nama" id="forNama" autocomplete="off" required value="<?= $tables["nama"]; ?>"><br>

            <label for="forEmail">Email :</label>
            <input type="text" name="email" id="forEmail" autocomplete="off" required value="<?= $tables["email"]; ?>"><br>

            <label for="forFoto">Email :</label>
            <img src="img/<?= $tables["foto"]; ?>">
            <input type="file" name="foto" id="forFoto" accept=".jpg, .png, .jpeg"><br>

            <button type="submit" name="submit" id="submit">ubah</button>
            <a href="index.php" id="cancel">batal ubah</a>
        </fieldset>
    </form>
    
</body>
</html>
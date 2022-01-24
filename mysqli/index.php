<?php
    session_start();
    if( !isset($_SESSION["login"]) ){
        header("location: login.php");
        die();
    }
    require('function.php');

    $halaman = pagination($_GET)[0];
    $shown = pagination($_GET)[1];
    $index = pagination($_GET)[2];
    $tables = pagination($_GET)[3];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="hide">home</title>

    <style>
        *{
            box-sizing: border-box;
        }
        body{
            font-family: sans-serif;
            margin: 0;
        }
        .container{
            width: max-content;
            min-width: 650px;
            margin: auto;
            box-shadow: 0 0 10px gray;
        }
        input#search{
            width: 50%;
            float: left;
            outline: 0;
        }
        .page{
            border-bottom: 0;
            margin: auto;
            display: flex;
            justify-content: center;
        }
        .page a{
            color: blue;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
        }
        #aktif{
            color: #fff;
            background: blue;
        }
        .page a:hover{
            color: #fff;
            background: blue;
        }
        table{
            margin: 0 0 20px 0;
            width: 100%;
        }
        .search{
            margin: 0;
            border-bottom: 0;
        }
        img{
            width: 50px;
            height: 50px;
        }
        #back{
            padding: 10px;
            margin: 20px;
            float: left;
            background: blue;
            text-decoration: none;
            color: #fff;
        }
        .right{
            margin: 20px;
            padding: 5px;
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            border: 1px solid #333333;
        }
        .right summary{
            user-select: none;
        }
        #logout, #print{
            text-decoration: none;
            border: 1px solid blue;
            color: blue;
            padding: 5px;
            margin: 20px 0 0 0;
            display: inline-block;
        }
        #logout:active{
            background: yellow;
        }
        .both{
            clear: both;
        }
        th{
            background: #333333;
            color: #fff;
        }
        .bg:nth-child(even){
            background: #cccccc;
        }
        .btn-tbl{
            text-decoration: none;
            padding: 5px 10px;
            margin: 5px;
            color: #fff;
            display: inline-block;
        }
        .btn-tbl:first-child{
            background: blue;
        }
        .btn-tbl:last-child{
            background: red;
        }
    </style>
</head>
<body>
    <details class="right">
        <summary>menu</summary>
            <a href="logout.php" id="logout">logout</a>
            <a href="print.php" id="print" target="blank">print</a>
    </details>

    <a href="add.php" id="back">tambah data</a>
    <div class="both"></div>

    <div class="container">
        <div class="page" id="page">
            <?php for( $z=1; $z<=$halaman; $z++ ) { ?>
                <?php if( $z == $shown ) { ?>
                    <a id="aktif" href="?hal=<?= $z; ?>"> <?= $z ?> </a>
                <?php }else{ ?>
                    <a href="?hal=<?= $z; ?>"> <?= $z ?> </a>
                <?php } ?>
            <?php } ?>
        </div>

        <table border="1" cellspacing="0" cellpadding="10" class="search">
            <tr>
                <th class="search">
                    <form action="" method="POST">
                        <input type="search" name="search" id="search" autocomplete="off" placeholder="search..." autofocus>
                    </form>
                </th>
            </tr>
        </table>

        <table border="1" cellspacing="0" cellpadding="10" id="table">
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            
            <?php $id = 1 + $index; ?>
            <?php foreach( $tables as $table ) { ?>
                <tr class="bg">
                    <td> <?= $id ?> </td>
                    <td> <?= $table["kls"]; ?> </td>
                    <td> <?= $table["jurusan"]; ?> </td>
                    <td> <?= $table["nama"]; ?> </td>
                    <td> <?= $table["email"]; ?> </td>
                    <td> <img src="img/<?= $table["foto"]; ?>"> </td>
                    <td>
                        <a href="update.php?id=<?= $table["id"]; ?>" class="btn-tbl">ubah</a>
                        <a href="delete.php?id=<?= $table["id"]; ?>&foto=<?= $table["foto"]; ?>" class="btn-tbl" onclick="return confirm('Hapus ?');">hapus</a>
                    </td>
                </tr>
                <?php $id++; ?>
            <?php } ?>
        </table>
    </div>

    <script src="js/js.js"></script>
</body>
</html>
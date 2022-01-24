<?php
session_start();
require('../system/redirect.php');
if (!isset($_SESSION['idUser'])) {
    echo "<script>alert('Login Terlebih Dahulu!'); window.location.replace('" . $redirectLogin . "');</script>";
    die();
}

require('../system/function.php');

$id = $_GET['id'];
$dataUser = show("core_byId", $id)[0];
if ($dataUser == NULL) {
    echo "<script> alert('Data Tidak Ditemukan!'); window.location.replace('" . $redirectAdmin . "');</script>";
    die();
}

if (isset($_POST['submit'])) {
    dataUpdate($dataUser, $_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <link rel="stylesheet" href="../css/indexUser.css">
    <link rel="icon" href="../img/icon.png">

</head>

<body>

    <p class="head">Update Data</p>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="box">
            <label for="nama">Nama Lengkap :</label>
            <input type="text" name="nama" id="nama" autocomplete="off" required value="<?= $dataUser['nama'] ?>">
        </div>

        <div class="box">
            <label for="smp">Asal SMP :</label>
            <input type="text" name="smp" id="smp" autocomplete="off" required value="<?= $dataUser['smp'] ?>">
        </div>

        <div class=" box">
            <label for="nisn">NISN :</label>
            <input type="number" name="nisn" id="nisn" autocomplete="off" required value="<?= $dataUser['nisn'] ?>">
        </div>

        <div class=" box">
            <label for="tempatlahir">Tempat Lahir :</label>
            <input type="text" name="tempatlahir" id="tempatlahir" autocomplete="off" required value="<?= $dataUser['tempat_lahir'] ?>">
        </div>

        <div class=" box">
            <label for="tgllahir">Tanggal Lahir :</label>
            <input type="date" name="tgllahir" id="tgllahir" autocomplete="off" required value="<?= $dataUser['tgl_lahir'] ?>">
        </div>

        <div class=" box">
            <label for="noHp">No.HP :</label>
            <input type="number" name="noHp" id="noHp" autocomplete="off" required value="<?= $dataUser['no_hp'] ?>">
        </div>

        <div class="box">
            <label for="Email">Email :</label>
            <input type="text" name="Email" id="Email" autocomplete="off" required value="<?= $dataUser['email'] ?>">
        </div>

        <div class="box inputDouble">
            <div class="subinput">
                <label for="ayah">Nama Ayah :</label>
                <input type="text" name="ayah" id="ayah" autocomplete="off" required value="<?= $dataUser['ayah'] ?>">
            </div>

            <div class="subinput">
                <label for="penghasilanayah">Penghasilan Ayah :</label>
                <input type="number" name="penghasilanayah" id="penghasilanayah" autocomplete="off" required value="<?= $dataUser['penghasilan_ayah'] ?>">
            </div>
        </div>

        <div class="box inputDouble">
            <div class="subinput">
                <label for="ibu">Nama Ibu :</label>
                <input type="text" name="ibu" id="ibu" autocomplete="off" required value="<?= $dataUser['ibu'] ?>">
            </div>

            <div class="subinput">
                <label for="penghasilanibu">Penghasilan Ibu :</label>
                <input type="text" name="penghasilanibu" id="penghasilanibu" autocomplete="off" required value="<?= $dataUser['penghasilan_ibu'] ?>">
            </div>
        </div>

        <div class="box">
            <label for="foto">Foto Anda:</label>
            <input type="file" name="foto" id="foto">
            <img src="../img/user/<?= $dataUser['foto'] ?>">
        </div>

        <div class="box">
            <button type="submit" name="submit">daftar</button>
        </div>
    </form>

</body>

</html>
<?php
require('redirect.php');

$db = new PDO('mysql:dbname=toskul;host=localhost', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SHOW DATA
function show($type, $val = null)
{
    global $db;

    if ($type == '*core') {
        $q = $db->prepare("SELECT * FROM `core`");
        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    } else if ($type == 'core_byId') {
        $q = $db->prepare("SELECT * FROM `core` WHERE id = :id");

        $q->bindParam(':id', $val, PDO::PARAM_INT);

        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
}

// ADD
function addData($val)
{
    global $db, $redirectUser;

    $nama            = htmlspecialchars($val['nama']);
    $smp             = htmlspecialchars($val['smp']);
    $nisn            = htmlspecialchars($val['nisn']);
    $tempatlahir     = htmlspecialchars($val['tempatlahir']);
    $tgllahir        = htmlspecialchars($val['tgllahir']);
    $hp              = htmlspecialchars($val['noHp']);
    $email           = htmlspecialchars($val['Email']);
    $ayah            = htmlspecialchars($val['ayah']);
    $penghasilanAyah = htmlspecialchars($val['penghasilanayah']);
    $ibu             = htmlspecialchars($val['ibu']);
    $penghasilanibu  = htmlspecialchars($val['penghasilanibu']);

    $foto = upload();
    if (!$foto) {
        die();
    }

    $statement = $db->prepare("INSERT INTO `core` VALUES('', :nama, :smp, :nisn, :tempatlahir, :tgllahir, :hp, :email, :ayah, :penghasilanAyah, :ibu, :penghasilanibu, :foto)");

    $statement->bindParam(':nama', $nama, PDO::PARAM_STR);
    $statement->bindParam(':smp', $smp, PDO::PARAM_STR);
    $statement->bindParam(':nisn', $nisn, PDO::PARAM_INT);
    $statement->bindParam(':tempatlahir', $tempatlahir, PDO::PARAM_STR);
    $statement->bindParam(':tgllahir', $tgllahir, PDO::PARAM_STR);
    $statement->bindParam(':hp', $hp, PDO::PARAM_INT);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':ayah', $ayah, PDO::PARAM_STR);
    $statement->bindParam(':penghasilanAyah', $penghasilanAyah, PDO::PARAM_INT);
    $statement->bindParam(':ibu', $ibu, PDO::PARAM_STR);
    $statement->bindParam(':penghasilanibu', $penghasilanibu, PDO::PARAM_INT);
    $statement->bindParam(':foto', $foto, PDO::PARAM_STR);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo "<script>alert('Berhasil Daftar'); window.location.replace('" . $redirectUser . "');</script>";
        die();
    } else {
        echo "<script>alert('Gagal Daftar!'); window.location.replace('" . $redirectUser . "');</script>";
        die();
    }
}

// UPDATE
function dataUpdate($dataOld, $val)
{
    global $db, $redirectAdmin;

    $nama            = htmlspecialchars($val['nama']);
    $smp             = htmlspecialchars($val['smp']);
    $nisn            = htmlspecialchars($val['nisn']);
    $tempatlahir     = htmlspecialchars($val['tempatlahir']);
    $tgllahir        = htmlspecialchars($val['tgllahir']);
    $hp              = htmlspecialchars($val['noHp']);
    $email           = htmlspecialchars($val['Email']);
    $ayah            = htmlspecialchars($val['ayah']);
    $penghasilanAyah = htmlspecialchars($val['penghasilanayah']);
    $ibu             = htmlspecialchars($val['ibu']);
    $penghasilanibu  = htmlspecialchars($val['penghasilanibu']);

    if ($_FILES['foto']['error'] == 4) {
        $foto = $dataOld['foto'];
    } else {
        $foto = upload();
        if ($foto) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/toskul/img/user/' . $dataOld['foto']);
        } else {
            echo "<script> alert('Gagal Mengunggah Foto!'); window.location.replace('" . $redirectAdmin . "');</script>";
            die();
        }
    }

    if (($nama == $dataOld['nama']) &&
        ($smp == $dataOld['smp']) &&
        ($nisn == $dataOld['nisn']) &&
        ($tempatlahir == $dataOld['tempat_lahir']) &&
        ($tgllahir == $dataOld['tgl_lahir']) &&
        ($hp == $dataOld['no_hp']) &&
        ($email == $dataOld['email']) &&
        ($ayah == $dataOld['ayah']) &&
        ($penghasilanAyah == $dataOld['penghasilan_ayah']) &&
        ($ibu == $dataOld['ibu']) &&
        ($penghasilanibu == $dataOld['penghasilan_ibu']) &&
        ($dataOld['foto'] == $foto)
    ) {
        echo "<script> alert('Tidak Ada Perubahan!'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    }

    $q = $db->prepare("UPDATE `core` 
                        SET nama = :nama,
                            smp = :smp,
                            nisn = :nisn,
                            tempat_lahir = :tempatlahir,
                            tgl_lahir = :tgllahir,
                            no_hp = :hp,
                            email = :email,
                            ayah = :ayah,
                            penghasilan_ayah = :penghasilanAyah,
                            ibu = :ibu,
                            penghasilan_ibu = :penghasilanibu,
                            foto = :foto
                        WHERE id = :id");

    $q->bindParam(':nama', $nama, PDO::PARAM_STR);
    $q->bindParam(':smp', $smp, PDO::PARAM_STR);
    $q->bindParam(':nisn', $nisn, PDO::PARAM_INT);
    $q->bindParam(':tempatlahir', $tempatlahir, PDO::PARAM_STR);
    $q->bindParam(':tgllahir', $tgllahir, PDO::PARAM_STR);
    $q->bindParam(':hp', $hp, PDO::PARAM_INT);
    $q->bindParam(':email', $email, PDO::PARAM_STR);
    $q->bindParam(':ayah', $ayah, PDO::PARAM_STR);
    $q->bindParam(':penghasilanAyah', $penghasilanAyah, PDO::PARAM_INT);
    $q->bindParam(':ibu', $ibu, PDO::PARAM_STR);
    $q->bindParam(':penghasilanibu', $penghasilanibu, PDO::PARAM_INT);
    $q->bindParam(':foto', $foto, PDO::PARAM_STR);
    $q->bindParam(':id', $dataOld['id'], PDO::PARAM_INT);
    $q->execute();

    if ($q->rowCount() > 0) {
        echo "<script> alert('Berhasil Memperbarui Data'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    } else {
        echo "<script> alert('Gagal Memperbarui Data!'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    }
}

// UPLOAD FOTO
function upload()
{
    global $redirectUser;

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES["foto"]["error"];

    $ekstensiTrue = ['jpg', 'png', 'jpeg'];
    $ekstensiUser = explode('.', $namaFile);
    $namaEkstensiUser = strtolower(end($ekstensiUser));

    if ($error === 4) {
        echo "<script> alert('masukan foto'); window.location.replace('" . $redirectUser . "');</script>";
        return false;
    }

    if (in_array($namaEkstensiUser, $ekstensiTrue) === false) {
        echo "<script> alert('masukan jpg/png/jpeg'); window.location.replace('" . $redirectUser . "');</script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script> alert('batas maksimal file adalah 1 MB'); window.location.replace('" . $redirectUser . "');</script>";
        return false;
    }

    $newFileName = uniqid() . '.' . $namaEkstensiUser;

    move_uploaded_file($tmpName, '../img/user/' . $newFileName);
    return $newFileName;
}

// DELETE
function dataDelete($id)
{
    global $db, $redirectAdmin;

    $getData = show('core_byId', $id)[0];

    if ($getData == NULL) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    }

    $q = $db->prepare("DELETE FROM `core` WHERE id = :id");
    $q->bindParam(':id', $id, PDO::PARAM_INT);
    $q->execute();

    if ($q->rowCount() > 0) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/toskul/img/user/' . $getData['foto']);
        echo "<script>alert('Berhasil Menghapus Data!'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    } else {
        echo "<script>alert('Gagal Menghapus Data!'); window.location.replace('" . $redirectAdmin . "');</script>";
        die();
    }
}

// LOGIN
function login()
{
    global $db, $redirectLogin, $redirectAdmin;

    $username = $_POST['username'];
    $password = $_POST['pass'];

    $q = $db->prepare("SELECT * FROM `user_admin` WHERE username = :username OR email = :email");

    $q->bindParam(':username', $username, PDO::PARAM_STR);
    $q->bindParam(':email', $username, PDO::PARAM_STR);

    $q->execute();

    if ($q->rowCount() == 1) {
        $dataUser = $q->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $dataUser['pass'])) {
            $_SESSION['idUser'] = $dataUser['id'];
            echo "<script>alert('Berhasil Login!'); window.location.replace('" . $redirectAdmin . "');</script>";
            die();
        } else {
            echo "<script>alert('Username/Password Salah!'); window.location.replace('" . $redirectLogin . "');</script>";
            die();
        }
    } else {
        echo "<script>alert('Username/Password Salah!'); window.location.replace('" . $redirectLogin . "');</script>";
        die();
    }
}

function logout()
{
    global $redirectLogin;

    unset($_SESSION['idUser']);
    session_destroy();

    echo "<script>alert('Berhasil Logout!'); window.location.replace('" . $redirectLogin . "');</script>";
    die();
}

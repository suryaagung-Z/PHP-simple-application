<?php
session_start();
require('../system/redirect.php');
if (!isset($_SESSION['idUser'])) {
    echo "<script>alert('Login Terlebih Dahulu!'); window.location.replace('" . $redirectLogin . "');</script>";
    die();
}

require('../system/function.php');
$userData = show("*core");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index | Admin</title>

    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/indexAdmin.css">
</head>

<body>
    <a href="<?= $url ?>system/logout.php" class="logout" onclick="return confirm('Logout?')">logout</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Asal SMP</th>
            <th>NISN</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>No.HP</th>
            <th>Email</th>
            <th>Nama Ayah</th>
            <th>Penghasilan Ayah</th>
            <th>Nama Ibu</th>
            <th>Penghasilan Ibu</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php if ($userData == NULL) { ?>
            <tr>
                <td colspan="14" class="noresults">no results</td>
            </tr>
        <?php } else {
            $no = 1; ?>
            <?php foreach ($userData as $ud) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $ud['nama'] ?></td>
                    <td><?= $ud['smp'] ?></td>
                    <td><?= $ud['nisn'] ?></td>
                    <td><?= $ud['tempat_lahir'] ?></td>
                    <td><?= $ud['tgl_lahir'] ?></td>
                    <td><?= $ud['no_hp'] ?></td>
                    <td><?= $ud['email'] ?></td>
                    <td><?= $ud['ayah'] ?></td>
                    <td><?= $ud['penghasilan_ayah'] ?></td>
                    <td><?= $ud['ibu'] ?></td>
                    <td><?= $ud['penghasilan_ibu'] ?></td>
                    <td><img src="../img/user/<?= $ud['foto'] ?>"></td>
                    <td>
                        <div class="aksi">
                            <a href="update.php?id=<?= $ud['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $ud['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                        </div>
                    </td>
                </tr>
        <?php }
        } ?>
    </table>
</body>

</html>
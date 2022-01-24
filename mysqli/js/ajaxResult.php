<?php
    require('../function.php');
    $search = $_GET["search"];
    $tablesAjax;

    if( $search === 'x' || $search === 'xi' || $search === 'xii' ){
        $query = "SELECT * FROM one WHERE
                    kls = '$search'
                  ORDER BY nama";
        $tablesAjax = read($query);
    }
    else if( $search === "" ){
        $tablesAjax = pagination(false)[3];
    }
    else{
        $query = "SELECT * FROM one WHERE
                    kls LIKE '%$search%' OR
                    jurusan LIKE '%$search%' OR
                    nama LIKE '%$search%' OR
                    email LIKE '%$search%'
                  ORDER BY nama";
        $tablesAjax = read($query);
    }
?>

<style>
    h4{
        text-align: center;
    }
    img{
        width: 50px;
        height: 50px;
    }
    [href="add.php"]{
        padding: 10px;
        margin: 20px;
        float: right;
        background: blue;
        text-decoration: none;
        color: #fff;
    }
    [href="logout.php"]{
        text-decoration: none;
        border: 1px solid blue;
        color: blue;
        padding: 5px;
        margin: 20px;
        display: inline-block;
    }
</style>

<?php if( $tablesAjax ) { ?>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        
        <?php $id = 1 ?>
        <?php foreach( $tablesAjax as $table ) { ?>
            <tr class="bg">
                <td> <?= $id ?> </td>
                <td> <?= $table["kls"]; ?> </td>
                <td> <?= $table["jurusan"]; ?> </td>
                <td> <?= $table["nama"]; ?> </td>
                <td> <?= $table["email"]; ?> </td>
                <td><img src="img/<?= $table["foto"]; ?>"></td>
                <td>
                    <a href="update.php?id=<?= $table["id"]; ?>&foto=<?= $table["foto"]; ?>" class="btn-tbl">ubah</a>
                    <a href="delete.php?id=<?= $table["id"]; ?>&foto=<?= $table["foto"]; ?>" class="btn-tbl" onclick="return confirm('Hapus ?');">hapus</a>
                </td>
            </tr>
            <?php $id++; ?>
        <?php } ?>
    </table>
<?php }else{?>
    <table border="1" cellspacing="0" cellpadding="10" id="none">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        
        <tr>
            <td colspan="7">
                <h4>Not found</h4>
            </td>
        </tr>
    </table>
<?php } ?>
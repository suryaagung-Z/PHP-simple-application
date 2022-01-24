<?php
    $connectDB = mysqli_connect('localhost', 'root', 'sury44gung', 'suryaagung');
    error_reporting(0);

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~READ
    function read($queryRead){
        global $connectDB;

        $tabel = mysqli_query($connectDB, $queryRead);
        while( $row = mysqli_fetch_assoc($tabel) ){
            $rows[] = $row;
        }

    return $rows;
    }
    
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CREATE
    function add($post){
        global $connectDB;

        $kls = htmlspecialchars($post["kelas"]);
        $jurusan = htmlspecialchars($post["jurusan"]);
        $nama = htmlspecialchars($post["nama"]);
        $email = htmlspecialchars($post["email"]);
        
        $foto = upload();
        if( !$foto ){
            return false;
        }

        $queryAdd = "INSERT INTO one VALUES
                        ('', '$kls', '$jurusan', '$nama', '$email', '$foto')";

        mysqli_query($connectDB, $queryAdd);

    return;
    }

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~DELETE
    function delete($id, $foto){
        global $connectDB;

        // hapus foto di directory
        unlink("img/".$foto);

        // hapus row dari id tertentu
        $queryDelete = "DELETE FROM one WHERE id = $id";
        mysqli_query($connectDB, $queryDelete);

    return mysqli_affected_rows($connectDB);
    }

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~UPDATE
    function update($post, $id, $fotoLama){
        global $connectDB;

        $kls = htmlspecialchars($post["kelas"]);
        $jurusan = htmlspecialchars($post["jurusan"]);
        $nama = htmlspecialchars($post["nama"]);
        $email = htmlspecialchars($post["email"]);

        $error = $_FILES["foto"]["error"];
        if( $error === 4 ){
            $fotoBaru = $fotoLama;
        }else{
            $fotoBaru = upload();
            if( $fotoBaru ){
                unlink("img/".$fotoLama);
            }else{
                return false;
            }
        }

        $queryUpdate = "UPDATE one SET 
                            kls = '$kls',
                            jurusan = '$jurusan',
                            nama = '$nama',
                            email = '$email',
                            foto = '$fotoBaru'
                        WHERE id = $id
                        ";

        mysqli_query($connectDB, $queryUpdate);

    return mysqli_affected_rows($connectDB);
    }

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~UPLOAD FILE
    function upload(){

        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $tmpName = $_FILES['foto']['tmp_name'];
        $error = $_FILES["foto"]["error"];

        $ekstensiTrue = ['jpg', 'png', 'jpeg'];
        $ekstensiUser = explode('.', $namaFile);
        $namaEkstensiUser = strtolower(end($ekstensiUser));

        if( $error === 4 ){
            echo "<script> alert('masukan foto') </script>";
            return false;
        }

        if( in_array($namaEkstensiUser, $ekstensiTrue) === false ){
            echo "<script> alert('masukan jpg/png/jpeg') </script>";
            return false;
        }

        if( $ukuranFile > 1000000){
            echo "<script> alert('batas maksimal file adalah 1 MB') </script>";
            return false;
        }

        $newFileName = uniqid().'.';
        $newFileName .= $namaEkstensiUser;

        move_uploaded_file($tmpName, 'img/'.$newFileName);
    return $newFileName;
    }

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~REGISTRATION
    function regis($post){
        global $connectDB;

        $user = $post["username"];
        $email = $post["email"];
        $password = $post["password"];
        $passwordConfirm = $post["passwordConfirm"];

        $blacklistChars = '"%\'*;<>?^`{|}~/\\#=&';
        $pattern = preg_quote($blacklistChars, '/');
        if (preg_match('/[' . $pattern . ']/', $user)) {
            echo "<script> alert('Username tidak boleh ada karakter khusus'); </script>";
            return false;
        }

        if( $user === "" ){
            echo "<script> alert('Username tidak boleh kosong'); </script>";
            return false;
        }
        if( $email === "" ){
            echo "<script> alert('Email tidak boleh kosong'); </script>";
            return false;
        }
        if( $password === "" || $passwordConfirm === ""){
            echo "<script> alert('Password tidak boleh kosong'); </script>";
            return false;
        }
        if( $password !== $passwordConfirm ){
            echo "<script> alert('konfirmasi password tidak sesuai'); </script>";
            return false;
        }

        $userToDB = mysqli_real_escape_string($connectDB, $user);
        $emailToDB = mysqli_real_escape_string($connectDB, $email);
        $pwToDB = mysqli_real_escape_string($connectDB, $password);

        //cek kesamaan username didatabase
        $cekUser = mysqli_num_rows(mysqli_query($connectDB, "SELECT username FROM users WHERE username = '$userToDB' "));
        if( $cekUser === 1 ){
            echo "<script> alert('Username tidak tersedia'); </script>";
            return false;
        }

        $cekEmail = mysqli_num_rows(mysqli_query($connectDB, "SELECT username FROM users WHERE email = '$emailToDB' "));
        if( $cekEmail ){
            echo "<script> alert('Email tidak tersedia'); </script>";
            return false;
        }

        $encryption = password_hash($pwToDB, PASSWORD_DEFAULT);

        mysqli_query($connectDB, "INSERT INTO users VALUES('', '$userToDB', '$emailToDB', '$encryption')");

    return mysqli_affected_rows($connectDB);
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~LOGIN
    function login($post){
        global $connectDB;

        $username = $post["username"];
        $password = $post["password"];

        $cekUser = mysqli_query($connectDB, "SELECT * FROM users WHERE username = '$username' ");

        if( mysqli_num_rows($cekUser) === 1 ){
            $dataUser = mysqli_fetch_assoc($cekUser);

            if( password_verify($password, $dataUser["password"]) ){
                if( isset($post["remember"]) ){
                    setcookie('login', 'true', time()+60);
                }

                $_SESSION["login"] = true;
                header("location: index.php");
                die;
            }
        }
        $error = true;

        return $error;
    }

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PAGINATION
    function pagination($get){
        global $connectDB;

        $perHalaman = 3;
        $numRows = mysqli_num_rows(mysqli_query($connectDB,"SELECT * FROM one"));
        $halaman = ceil($numRows / $perHalaman);
        if( isset($get["hal"]) ){
            $shown = $get["hal"];
        }else{
            $shown = 1;
        }
        
        $index = ( $shown * $perHalaman ) - $perHalaman;
        $tables = read("SELECT * FROM one ORDER BY nama LIMIT $index, $perHalaman");

    return [$halaman, $shown, $index, $tables];
    }

?>
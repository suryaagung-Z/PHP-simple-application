<?php
    require('function.php');

    if( isset($_POST["submit"]) ){
        
        if( regis($_POST) > 0 ){
            echo "<script> alert('Berhasil registrasi'); </script>";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman registrasi</title>

    <style>
        *{
            box-sizing: border-box;
        }
        html{
            height: 100%;
        }
        body{
            height: 100%;
            margin: 0;
            color: #fff;
            background-image: url(img/background.png);
            background-position: center;
            background-size: cover;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #login{
            text-decoration: none;
            color: #fff;
            background-color: #3a86ff;
            padding: 10px;
            border-radius: 5px; 
            position: absolute;
            top: 20px;
            right: 20px;
        }
        form{
            width: 400px;
            min-width: 300px;
            padding: 20px 40px;
            margin: 80px auto;
            border-radius: 5px;
            background-color: rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
        }
        h1{
            margin: 0 0 40px 0;
            text-align: center;
        }
        input{
            outline: 0;
            caret-color: blue;
            width: 100%;
            margin: 0 0 20px 0;
        }
        #submit{
            width: 100px;
            color: #fff;
            padding: 10px 20px;
            background: #3a86ff;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .hoverBlue:hover{
            background-color: blue !important;
        }
    </style>
</head>
<body>
    
    <a href="login.php" id="login" class="hoverBlue">Login?</a>

    <form action="" method="POST">
        <h1>Registration</h1>
            <label for="forUser">Username :</label>
            <input type="text" name="username" id="forUser" autocomplete="off" placeholder="a-z A-Z 0-9" pattern="[a-zA-Z0-9]*" required>

            <label for="forEmail">Email :</label>
            <input type="email" name="email" id="forEmail" autocomplete="off" required>

            <label for="forPassword">Password :</label>
            <input type="password" name="password" id="forPassword" autocomplete="off" required>

            <label for="forPassword2">Konfirmasi password :</label>
            <input type="password" name="passwordConfirm" id="forPassword2" autocomplete="off" required>

            <button type="submit" name="submit" id="submit" class="hoverBlue" onclick="return confirm('Registrasi ???');">buat</button>
    </form>

</body>
</html>
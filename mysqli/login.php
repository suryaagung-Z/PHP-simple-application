<?php
    session_start();
    if( isset($_COOKIE['login']) == 'true' ){
        $_SESSION["login"] = true;
    }
    if( isset($_SESSION["login"]) ){
        header("location: index.php");
        die;
    }

    require('function.php');

    if( isset($_POST["submit"]) ){
        $error = login($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman login</title>

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
        #regis{
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
        }
        h1{
            margin: 0 0 40px 0;
            text-align: center;
        }
        input[type="text"], input[type="password"]{
            outline: 0;
            caret-color: blue;
            width: 100%;
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

    <a href="registrasi.php" id="regis" class="hoverBlue">registrasi?</a>
    
    <form action="" method="POST">
        <h1>LOGIN</h1>
            <?php if( $error ) { ?>
                <p style="color: red; font-style: italic;">username/password salah</p>
            <?php } ?>

            <label for="forUser">Username :</label><br>
            <input type="text" name="username" id="forUser" autocomplete="off" required><br><br>

            <label for="forPassword">Password :</label><br>
            <input type="password" name="password" id="forPassword" autocomplete="off" required><br><br>

            <input type="checkbox" name="remember" id="forRemember" autocomplete="off">
            <label for="forRemember">Remember me</label><br><br>

            <button type="submit" name="submit" id="submit" class="hoverBlue">login</button><br><br>
    </form>

</body>
</html>
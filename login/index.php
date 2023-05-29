<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    header("Location: ../app/");
}
elseif(isset($_SESSION['admin'])){
    header("Location:../admin/");
}
else{
    if ($_POST){
        $error="style='background-color: #ffffffaa;'";
        $user =mysqli_real_escape_string($con,$_POST["email"]);
        $password =mysqli_real_escape_string($con,$_POST["password"]);
        $sql= "SELECT `id`, `password` FROM `Profile` WHERE email = '$user'";
        $login_result = mysqli_query($con,$sql);
        if(mysqli_num_rows($login_result)>0){
            while($row = mysqli_fetch_array($login_result))
            {
                $passwordHash = $row['password'];
                $myId=$row['id'];
            }
            if(!password_verify($password,$passwordHash)){
                $error="style='background-color: #ff8181b0;'";
            }
            else{
                $_SESSION['user']=$myId;
                header("Location: ../app/");
            }
        }
        else{
            $sql= "SELECT `password` FROM `Admin` WHERE id = '$user'";
            $login_result = mysqli_query($con,$sql);
            if(mysqli_num_rows($login_result)>0){
                while($row = mysqli_fetch_array($login_result))
                {
                    $passwordHash = $row['password'];
                }
                if(!password_verify($password,$passwordHash)){
                    $error="style='background-color: #ff8181b0;'";
                }
                else{
                    $_SESSION['admin']=$user;
                    header("Location: ../admin/");
                }
            }
            echo '<script>if (confirm("User does not exist, Create a new account?")) {
                window.location.replace("../register/");
            }</script>';
        }


    }
}


?>




<!DOCTYPE html>
    <head>
        <title>LOGIN</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- Section 1 -->
        <section id="login-section" class="s">
            <div id="navbar">
                <a href="../home/"><img src="../files/logo.png" id="logo"></a>
                <ul id="menu">
                    <li><a href="../about">About</a></li>
                    <li><a href="../register" id="join-btn">Join</a></li>
                </ul>
            </div>
            <div class="blur">
            <form id="login-form" method="post">
                <div id="form-title">Login</div>
                <input class="input-field" id="email" placeholder="Email" name="email" type="email" required>
                <input class="input-field" id="password" placeholder="Password" name="password" type="password" required <?php echo $error ?>>
                
                <button id="login" type="submit">Login</button>
                <button id="google" class="reg-btn-1" onclick="window.open('../login')"><img src="../files/google.png"></button>
                <div id="reg">Not yet registered?<a href="../register/"> Register Now!</a></div>
            </form>
            </div>
        </section>
    </body>
</html>
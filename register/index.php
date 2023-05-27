<?php
include '../config.php';

session_start();

function generateId($email) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
 
    for ($i = 0; $i < 15; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    $username = explode("@", $email);
    $username = array_shift($username);

    return $username.'@solotreff/'.$randomString;
}

if(isset($_SESSION['user'])){
    header("Location: ../app/");
}

else{
    if ($_POST){
        $name =mysqli_real_escape_string($con,$_POST["name"]);
        $email =mysqli_real_escape_string($con,$_POST["email"]);
        $password =mysqli_real_escape_string($con,$_POST["password"]);
        $sql= "SELECT id FROM `Profile` WHERE email = '$email'";
        $user_result = mysqli_query($con,$sql);

        if(mysqli_num_rows($user_result)>0){
            echo '<script>if (confirm("User already exists, Login?")) {window.location.replace("../login/");}</script>';
        }
        else{
            $password = password_hash($password,PASSWORD_DEFAULT);
            $myId= generateId($email);
            $sql="INSERT INTO `Profile` (`id`, `name`, `email`, `password`, `phone`, `location`, `profilepic`, `title`, `linkedin`, `socialmedia`, `projects`, `rating`, `description`) VALUES ('$myId','$name','$email', '$password', NULL, NULL, 'https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80', 'nil', NULL, NULL, 0, 0.0, 'nil');";
            // $sql="INSERT INTO `Profile` VALUES('$myId','$name','$email', NULL, NULL, NULL, 'nil', NULL, NULL,'0', '0.0', NULL, '$password')";
            if(!mysqli_query($con,$sql)){
                die('Error: '.mysqli_error($con));
            }
            $_SESSION['user']=$myId;
            header("Location: ../profile/");
        }
    }
}


?>




<!DOCTYPE html>
    <head>
        <title>REGISTER</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        
        <!-- Google API -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>


        <!-- JavaScript -->
        <script>
            function changeColor(){
                document.getElementById("type1").style = "background-color:#ffffffaa";
            }
            function verifyRegistration()
            {
                document.getElementById("name").style = "background-color: #ffffffaa";
                document.getElementById("pass1").style = "background-color: #ffffffaa";
                document.getElementById("pass").style = "background-color: #ffffffaa";
                document.getElementById("email").style = "background-color: #ffffffaa";
                var p1 = document.getElementById("pass").value;
                var p2 = document.getElementById("pass1").value;
                var email = document.getElementById("email").value;
                var name = document.getElementById("name").value;
                // var accType = document.getElementById("type1").value;
                var regEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                var emailEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                if(name.trim() =="")
                {
                    document.getElementById("name").style = "background-color: #ff8181b0";
                    return false;
                }
                if(email.trim()=="" || !(emailEx.test(email)))
                {
                    document.getElementById("email").style = "background-color: #ff8181b0";
                    return false;
                }
                // if(accType!="Freelancer" && accType!="Business"){
                //     document.getElementById("type1").style = "background-color:#ff8181b0";
                // }
                if(p1.trim()=="" || !(regEx.test(p1)))
                {
                    document.getElementById("pass").style = "background-color: #ff8181b0";
                    return false;
                }
                if(p1 == p2){
                    document.getElementById("pass1").style = "background-color: white";
                    // const id = text.split("@");
                    // document.getElementById("id").innerHTML = id[0]+'@solotreff/'+makeid(5);
                    return true;
                }
                else{
                    document.getElementById("pass1").style = "background-color: #ff8181b0";
                    return false;
                }
            }
            
            
        </script>
    </head>





    <body>
        <!-- Section 1 -->
        <section id="login-section" class="s">
            <div id="navbar">
                <a href="../home/"><img src="../files/logo.png" id="logo"></a>
                <ul id="menu">
                    <li><a href="../about">About</a></li>
                    <!-- <li><a href="../login">Log In</a></li> -->
                    <li><a href="../login/" id="join-btn">Login</a></li>
                </ul>
            </div>
            <div class="blur">
                <!-- Registration form -->
                <form id="register-form" onsubmit ="return verifyRegistration()" method="post">
                    <div id="form-title">Register</div>
                    <input class="input-field" type="text" id="name" name="name" placeholder="Name*" required>
                    <!-- <select class="dropdown-type" name="type" id="type1" onchange="changeColor()">
                          <option>Select*</option>
                          <option value="Freelancer">Freelancer</option>
                          <option value="Business">Business</option>
                    </select> -->
                    <input class="input-field" type="email" id="email" name="email" placeholder="Email*" required>
                    <input class="input-field" type="text" id="id" name="id" style="display: none;">
                    <input class="input-field" type="password" name="password" id="pass" placeholder="Password*" required title="Must contain 8 characters including atlest 1 lowercase, uppercase letter, number and a special character">
                    <input class="input-field" type="password" id="pass1" placeholder="Re Enter Password*" required>
                    <input id="reg-business" class="reg-btn-1" type="submit" value="Register">
                    <button id="google" class="reg-btn-1" onclick="window.open('../login')"><img src="../files/google.png"></button>
                    <div id="log">Already registered?<a href="../login/"> Login Now!</a></div>
                </form>
            </div>
        </section>
    </body>
</html>
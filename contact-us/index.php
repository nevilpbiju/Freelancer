<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){

    $myid = $_SESSION['user'];

    $navbar='<ul class="nav-menu"><li><a href="../message/" class="menu-item">Chat</a></li>
    <li><a href="../profile/" class="menu-item">Profile</a></li>
    <li><a href="../about/" class="menu-item">About</a></li>
    <li><a href="../logout/" class="menu-item">Logout</a></li></ul>';

    // fetching profile details
    $sql = "SELECT `name`, `email` from `Profile` where `id`='$myid'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $name = $row['name'];
        $email = $row['email'];
    }

    $formField='<input type="text" class="contact-name" id="name" name="name" readonly value="'.$name.'"><br/>
    <input type="text" class="contact-email" id="email" name="email" readonly value="'.$email.'"><br/>';
}
else{
    $navbar='<ul class="nav-menu">
    <li><a href="../about/" class="menu-item">About</a></li>
    <li><a href="../login/" class="menu-item">Login</a></li>
    <li><a href="../register/" class="menu-item">Join</a></li></ul>';
    $formField='<input type="text" class="contact-name" id="name" name="name" placeholder="Name*" required><br/>
    <input type="text" class="contact-email" id="email" name="email" placeholder="Email*" required><br/>';
}

// Update details
if ($_POST){
    $name =mysqli_real_escape_string($con,$_POST["name"]);
    $title =mysqli_real_escape_string($con,$_POST["email"]);
    $msg =mysqli_real_escape_string($con,$_POST["msg"]);
    $sql= "INSERT INTO `mail`(`email`, `name`, `msg`) VALUES ('$email','$name','$msg')";
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    }
}


?>

<!DOCTYPE html>
    <head>
        <title>SoloTreff</title>
	    <meta charset="utf-8">
	    <!-- Custom style -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="../style/navigation.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="../style/bootstrap.min.css" type="text/css">

    </head>
    <body class="home-page">
        <header>
            <nav class="navigation-bar">
                <a href="../app/"><img src="../files/black-logo.png" class="logo"></a>
                <form name="search-form" class="search-form" method="post" action="../search/">
                    <input type="text" autocomplete="off" name="search"  id="search" placeholder="Search..." required>
                    <!-- <button type="submit"></button> -->
                </form>
                <?php echo $navbar ?>
            </nav>
        </header>
        <section class="contact-section">
            <form class="contact" id="contact" name="contact" method="post">
                <h1 class="heading">Contact Us</h1>
                <?php echo $formField?>
                <input type="text" class="contact-msg" id="msg" name="msg" required placeholder="Message...*"><br/>
                <input type="submit" id="submit" class="contact-submit" name="submit" value="Send">
            </form>
        </section>
    </body>
</html>
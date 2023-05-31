<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){


    $myid = $_SESSION['user'];

    // fetching profile details
    $sql = "SELECT `name`, `title`, `phone`, `location`, `profilepic`, `linkedin`, `socialmedia`, `description` from `Profile` where `id`='$myid'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $location = $row['location'];
        $dp = $row['profilepic'];
        $linkedin = $row['linkedin'];
        $description = $row['description'];
    }


    // Update details
    if ($_POST){
        $name =mysqli_real_escape_string($con,$_POST["name"]);
        $title =mysqli_real_escape_string($con,$_POST["title"]);
        $phone =mysqli_real_escape_string($con,$_POST["phone"]);
        $location =mysqli_real_escape_string($con,$_POST["location"]);
        $linkedin =mysqli_real_escape_string($con,$_POST["linkedin"]);
        $summary =mysqli_real_escape_string($con,$_POST["summary"]);
        $sql= "UPDATE `Profile` SET `name`='$name',`phone`='$phone',`location`='$location',`title`='$title',`linkedin`='$linkedin', `description` = '$summary' WHERE `id`='$myid'";
        mysqli_query($con,$sql);
        if(!mysqli_query($con,$sql)){
            die('Error: '.mysqli_error($con));
        }
    }

}
else{
    header("Location: ../login/");
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

    
    <body class="profile-page">
    <header>
            <nav class="navigation-bar">
                <a href="../app/"><img src="../files/black-logo.png" class="logo"></a>
                <form name="search-form" class="search-form" method="post" action="../search/">
                    <input type="text" autocomplete="off" name="search"  id="search" placeholder="Search..." required>
                    <!-- <button type="submit"></button> -->
                </form>
                <ul class="nav-menu">
                    <!-- Chat -->
                    <li><a href="../message/" class="menu-item">Chat</a></li>
                    <!-- Profile -->
                    <li><a href="../profile/" class="menu-item">Profile</a></li>
                    <!-- Contact Us -->
                    <li><a href="../contact-us" class="menu-item">Contact us</a></li>
                    <!-- Logout -->
                    <li><a href="../logout/" class="menu-item">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="profile">
            <main class="profile-details">
                <div  class="profile-picture">
                    <img src="<?php echo $dp?>">
                </div>
                <form class="details-container" method="post">
                    <!-- <input type="file" class="profile-editor" id="dp" name="dp"><br/> -->
                    <input type="text" class="profile-editor" value="<?php echo $name?>" id="name" name="name" placeholder="Name"><br/>
                    <input type="text" class="profile-editor" value="<?php echo $title?>" id="title" name="title" placeholder="Title"><br/>
                    <input type="text" class="profile-editor" value="<?php echo $location?>" id="location" name="location" placeholder="Location"><br/>
                    <input type="text" class="profile-editor" value="<?php echo $linkedin?>" id="linkedin" name="linkedin" placeholder="LinkedIn"><br/>
                    <input type="text" class="profile-editor" value="<?php echo $phone?>" id="phone" name="phone" placeholder="Phone"><br/>
                    <textarea class="profile-editor summary-edit" id="summary" name="summary"><?php echo $description ?></textarea>
                    <button type="submit" class="btn" id="update-profile" name="update-profile">Update</button><br/>
                </form>
            </main>
        </section>
    </body>
</html>
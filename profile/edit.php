<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){


    $myid = $_SESSION['user'];



    // fetching profile details
    $sql = "SELECT `name`, `title`, `phone`, `location`, `profilepic`, `linkedin`, `socialmedia` from `Profile` where `id`='$myid'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $location = $row['location'];
        $dp = $row['profilepic'];
        $linkedin = $row['linkedin'];
        $socialmedia = $row['socialmedia'];
    }



    // Update details
    if ($_POST){
        $name =mysqli_real_escape_string($con,$_POST["name"]);
        $title =mysqli_real_escape_string($con,$_POST["title"]);
        $phone =mysqli_real_escape_string($con,$_POST["phone"]);
        $location =mysqli_real_escape_string($con,$_POST["location"]);
        $linkedin =mysqli_real_escape_string($con,$_POST["linkedin"]);
        $socialmedia =mysqli_real_escape_string($con,$_POST["socialmedia"]);
        $sql= "UPDATE `Profile` SET `name`='$name',`phone`='$phone',`location`='$location',`title`='$title',`linkedin`='$linkedin',`socialmedia`='$socialmedia' WHERE `id`='$myid'";
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
        <title>SOLOTREFF | PROFILE</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="../navigation.css" rel="stylesheet" type="text/css">

        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
        <section id="s1" class="app-screen">
            <div id="navbar">
                <img src="../files/icon.png" class="icon">
                <a href="../app/" class="nav-button"><img src="../files//Home.png" class="nav-logo"></a>
                <a href="../message/" class="nav-button"><img src="../files/message.png" class="nav-logo"></a>
                <a href="../search/" class="nav-button"><img src="../files/connections.png" class="nav-logo"></a>
                <a href="../logout/" class="nav-button"><img src="../files/exit.png" class="nav-logo"></a>
                <a href="../profile/" class="nav-button"><img src="<?php echo $dp?>" class="nav-logo" id="nav-dp"></a>
            </div>
            <section id="profile">
                <div class="bg">
                    <div id="profile-head">Profile</div>
                </div>
                <div class="profile-details">
                <img id="dp" src="<?php echo $dp?>">
                    <div><input type="file" class="profile-button" id="upload-dp" name="dp"></div>
                </div>
                <form id="edit-profile" method="post">
                    <div class="row">Name <input type="text" class="edit-input" id="name" name="name" value="<?php echo $name?>"></div>
                    <div class="row">Title <input type="text" class="edit-input" id="title" name="title" value="<?php echo $title?>"></div>
                    <div class="row">Phone <input type="text" class="edit-input" id="phone" name="phone" value="<?php echo $phone?>"></div>
                    <div class="row">Location <input type="text" class="edit-input" id="location" name="location" value="<?php echo $location?>"></div>
                    <div class="row">Linked In <input type="text" class="edit-input" id="linkedin" name="linkedin" value="<?php echo $linkedin?>"></div>
                    <div class="row">Social Media <input type="text" class="edit-input" id="socialmedia" name="socialmedia" value="<?php echo $socialmedia?>"></div>
                    <button id="save-profile" type="submit">Save</button>
                </form>
            </section>
        </section>
    </body>
</html>
<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    $myid = $_SESSION['user'];

    function generateId() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 25; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    // fetching profile details
    $sql = "SELECT `name`, `title`, `projects`, `rating`, `profilepic`, `description` from `Profile` where `id`='$myid'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $name = $row['name'];
        $title = $row['title'];
        $projects = $row['projects'];
        $rating = $row['rating'];
        $dp = $row['profilepic'];
        $description = $row['description'];
    }

    // Post
    if ($_POST){
        $content =mysqli_real_escape_string($con,$_POST["post"]);
        do{
            $postId = generateId();
            $sql = "SELECT * FROM `Post` WHERE `id` = '$postId'";
            $post=mysqli_query($con,$sql);
        }while(mysqli_num_rows($post)>0);
        
        $sql= "INSERT INTO `Post`(`id`, `content`, `wall`, `authorid`) VALUES ('$postId','$content','../files/graphic.jpg','$myid')";
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
    <body>
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
            <!-- Profile Info -->
            <main class="profile-details">
                <div  class="profile-picture">
                    <img src="<?php echo $dp?>">
                </div>
                <div class="post">
                    <form method="post">
                        <textarea placeholder="Write Here..." id="post-content" class="profile-editor" name="post" onkeyup="countChars()" maxlength="450" style="resize: none;" required></textarea>
                        <div id="charCount">0/450</div>
                        <a href="../profile/" class="btn">Cancel</a>
                        <label for="post-img" class="img-btn"><img src="../files/img-outline.png"></label><input type="file" name="post-img" id="post-img" style="display: none;">
                        <button id="save-profile" class="btn" type="submit">POST</button>
                    </form>
                </div>
            </main>
        <script type = "text/javascript" >
            function countChars() {
                var text = document.getElementById("post-content").value;
                var charCount = text.length;
                document.getElementById("charCount").innerHTML = charCount + " /450";
            }


            function preventBack() { window.history.forward(); }  
            setTimeout("preventBack()", 0);  
            window.onunload = function () { null };
        </script>

    </body>
</html>
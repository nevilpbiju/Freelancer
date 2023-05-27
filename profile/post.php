<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    $myid = $_SESSION['user'];

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
    </head>
    <body>
        <section id="s1" class="app-screen">
            <div id="navbar">
                <img src="../files/icon.png" class="icon">
                <a href="../app/" class="nav-button"><img src="../files//Home.png" class="nav-logo"></a>
                <a href="../message/" class="nav-button"><img src="../files/message.png" class="nav-logo"></a>
                <a href="../search/" class="nav-button"><img src="../files/connections.png" class="nav-logo"></a>
                <a href="../logout/" class="nav-button"><img src="../files/exit.png" class="nav-logo"></a>
                <a href="../profile/" class="nav-button"><img src="https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" class="nav-logo" id="nav-dp"></a>
            </div>
            <section id="profile">
                <div class="bg">
                    <div id="profile-head">Profile</div>
                </div>
                <div class="profile-details">
                    <img id="dp" src=<?php echo $dp?>>
                    <div class="name"><?php echo $name?></div>
                    <div id="title"><?php echo $title?></div>
                    <main class="details">
                        <div>PROJECTS<br><?php echo $projects?></div>
                        <div>RATING<br><?php echo $rating?></div>
                    </main>
                    <div>
                        <button id="connect" class="profile-button" onclick="history.back()">Cancel</button>
                    </div>
                </div>
                <div class="post">
                    <form method="post">
                        <textarea placeholder="Write Here..." id="post-content" name="post" onkeyup="countChars()" maxlength="450"></textarea>
                        <div id="charCount">0/450</div>
                        <input type="file" name="post-img" id="post-img">
                        <button id="save-profile" type="submit">Upload</button>
                    </form>
                </div>
            </section>
        </section>
    </body>
</html>
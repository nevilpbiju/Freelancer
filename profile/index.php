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


    // Fetching posts
    $sql = "SELECT `wall`, `content` FROM `Post` WHERE `authorid`='$myid'";
    $posts = mysqli_query($con,$sql);
    $post_view='';
    if(mysqli_num_rows($posts) > 0)
    {
        $post_view='<div id="posts">';
        while ($row = mysqli_fetch_array($posts)){
            $wall = $row['wall'];
            $content= $row['content'];
            $post_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url';
            $post_view.=$wall.'"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-word">';
            $post_view.=$content.'</div></td></tr></table>';
        }
        $post_view.='</div>';
        // Check point
    }

    // Fetching Reviews
    $sql = "SELECT Profile.name, Profile.profilepic, Review.rating, Review.review FROM `Review` INNER JOIN Profile ON Profile.id = Review.author WHERE Review.account='$myid'";
    $reviews = mysqli_query($con,$sql);
    $reviews_view='';
    if(mysqli_num_rows($reviews) > 0)
    {
        $reviews_view='<section class="review-container"><h3>Review</h3>';
        while ($row = mysqli_fetch_array($reviews)){
            $authorpic= $row['profilepic'];
            $author= $row['name'];
            $rating= $row['rating'];
            $rev= $row['review'];
            $reviews_view.='<main class="review-area"><div id="freelancer-details"><img src="';
            $reviews_view.=$authorpic.'" id="freelancer-img"><div id="freelancer-des"><div id="freelancer-name">';
            $reviews_view.=$author.'</div></div></div><div id="rating">';
            $reviews_view.=$rating.'</div><div id="review">';
            $reviews_view.=$rev.'</div></main>';
        }
        $reviews_view.='</section>';
    }

}
else{
    header("Location: ../login/");
}


?>


<!DOCTYPE html>
    <head>
        <title>SOLOTREFF | PROFILE</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../bootstrap.min.css" type="text/css">


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
                <!-- <img src="../files/icon.png" class="logo-icon"> -->
                <a href="../app/" class="nav-button"><img src="../files//Home.png" class="nav-logo"></a>
                <a href="../message/" class="nav-button"><img src="../files/message.png" class="nav-logo"></a>
                <a href="../search/" class="nav-button"><img src="../files/connections.png" class="nav-logo"></a>
                <a href="../logout/" class="nav-button"><img src="../files/exit.png" class="nav-logo"></a>
                <a href="#" class="nav-button"><img src="<?php echo $dp?>" class="nav-logo" id="nav-dp"></a>
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
                        <button id="connect" class="profile-button">Connect</button>
                        <a href="edit.php" class="profile-button">Edit</a>
                        <a href="post.php" class="profile-button">Post</a>
                    </div>
                </div>
                <div class="works">
                    <div id="intro">
                        <h3>Description</h3><?php echo $description?></div>
                        <?php echo $post_view?>
                        <!-- <div id="posts">
                        <table id="freelancer">
                            <tr><td id="freelancer-bg" style="background-image: url(../files/graphic.jpg)"></td></tr>
                            <tr><td id="freelancer-discription">
                                <div id="freelancer-word">I can design and develop web applications for you</div>
                            </td></tr>
                        </table>
                        </div> -->

                    <?php echo $reviews_view?>
                    <!-- <section class="review-container">
                        <h3>Review</h3>
                        <main class="review-area">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                </div>         
                            </div>
                            <div id="rating">4.5</div>
                            <div id="review">I had a great experience working with him, he was professional and 
                                communicative throughout our interactions. His attention to detail and creativity were impressive, 
                                and he put in a lot of effort to meet all of my requirements and expectations for the project.</div>
                        </main>
                    </section> -->
                </div>
            </section>
        </section>
    </body>
</html>
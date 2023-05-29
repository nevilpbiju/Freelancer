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

        $reviews_view='<main class="reviews">';
        while ($row = mysqli_fetch_array($reviews)){
            $authorpic= $row['profilepic'];
            $author= $row['name'];
            $rating= $row['rating'];
            $rev= $row['review'];
            $reviews_view.='<div class="review-content"><div class="author-details"><div class="author-dp"><img src="';
            $reviews_view.=$authorpic.'"></div><div class="author-name">';
            $reviews_view.=$author.'</div><div class="rating">';
            $reviews_view.=$rating.'</div></div><div class="review">';
            $reviews_view.=$rev.'</div></div>';
        }
        $reviews_view.='</main>';
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
        <link rel="stylesheet" type="text/css" href="profile.css">
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
            <!-- Profile Info -->
            <main class="profile-details">
                <div  class="profile-picture">
                    <img src="<?php echo $dp?>">
                </div>
                <div class="details-container">
                    <h5 class="profile-name"><?php echo $name?></h5>
                    <p class="profile-title" ><?php echo $title?></p>
                    <div class="profile-points">
                        <span>PROJECTS: <?php echo $projects?></span>
                        <span>RATING: <?php echo $rating?></span>
                    </div>
                    <a href="edit-profile.html" class="btn">Edit<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                </div>
            </main>
            <!-- Summary -->
            <main class="profile-content">
                <div class="summary-area">
                    <h3>Summary</h3>
                    <div class="summary"><?php echo $description?></div>
                </div>
            </main>
            <!-- Posts -->
            <main class="listing">
            <div class="category-table">
                <div class="category-label"></div>
                <div class="category-group">
                    <?php echo $post_view?>
                </div>
            </div>
            </main>
            <!-- Reviews -->
            <?php echo $reviews_view?>
        </section>
    </body>
</html>
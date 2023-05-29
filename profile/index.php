<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    $myid = $_SESSION['user'];

    // Generate ID
    function generateId() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 25; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    
    if(isset($_GET['account']) && $_GET['account']!=$myid){
        // Other's profile

        $account = $_GET['account'];

        $sql = "SELECT * FROM `Connection` WHERE (user1='$myid' AND user2='$account') OR (user1='$account' AND user2='$myid') ";
        $conns = mysqli_query($con,$sql);
        if(mysqli_num_rows($conns) == 0)
        {
            $profile_options='<button id="connect" class="btn" onclick="runSQL()">Connect</button>';
            $review_section='<div class="con-mgs">Connect to write a review</div>';
        }else{
            $review_section='<form name="review-form" class="review-form" method="post">
        <h5>Rating</h5>
        <fieldset class="star-rating">
            <input type="radio" id="star5" name="rating" value=1.0 required/>
            <label for="star5" title="5 stars"></label>
            <input type="radio" id="star4" name="rating" value=2.0 />
            <label for="star4" title="4 stars"></label>
            <input type="radio" id="star3" name="rating" value="3.0" />
            <label for="star3" title="3 stars"></label>
            <input type="radio" id="star2" name="rating" value="4.0" />
            <label for="star2" title="2 stars"></label>
            <input type="radio" id="star1" name="rating" value="5.0" />
            <label for="star1" title="1 star"></label>
        </fieldset>
        <h5>Add a review</h5>
        <textarea class="profile-editor" id="rev" name="rev" required></textarea>
        <button type="submit" class="btn" name="add-review" id="add-review">Save</button>
    </form>';
        }


        // fetching profile details
        $sql = "SELECT `name`, `title`, `projects`, `rating`, `profilepic`, `description` from `Profile` where `id`='$account'";
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
        $sql = "SELECT `wall`, `content` FROM `Post` WHERE `authorid`='$account'";
        $posts = mysqli_query($con,$sql);
        $post_view='';
        if(mysqli_num_rows($posts) > 0)
        {
            while ($row = mysqli_fetch_array($posts)){
                $wall = $row['wall'];
                $content= $row['content'];
                $post_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url(';
                $post_view.=$wall.')"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-word">';
                $post_view.=$content.'</div></td></tr></table>';
            }
            // Check point
        }

        // Fetching Reviews
        $sql = "SELECT Profile.name, Profile.profilepic, Review.rating, Review.review FROM `Review` INNER JOIN Profile ON Profile.id = Review.author WHERE Review.account='$account' ORDER BY Review.Time";
        $reviews = mysqli_query($con,$sql);
        $reviews_view='';
        $count = 0;
        $total = 0;
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
                $reviews_view.=$rating.'.0</div></div><div class="review">';
                $reviews_view.=$rev.'</div></div>';
                $count+=1;
                $total+=$rating;
            }
            $reviews_view.='</main>';
            $avg_rating=round($total/$count,2);
            $sql= "UPDATE `Profile` SET `rating` = '$avg_rating' WHERE `id`='$account'";
            mysqli_query($con,$sql);
            if(!mysqli_query($con,$sql)){
                die('Error: '.mysqli_error($con));
            }
        }

        // Post a review
        $author =$myid;
        
        if ($_POST){
            $review =mysqli_real_escape_string($con,$_POST["rev"]);
            $rat = $_POST['rating'];
        
            do{
                $reviewId = generateId();
                $sql = "SELECT * FROM `Review` WHERE `id` = '$reviewId'";
                $revs=mysqli_query($con,$sql);
            }while(mysqli_num_rows($revs)>0);

            $sql= "INSERT INTO `Review`(`id`, `rating`, `review`, `account`, `author`) VALUES ('$reviewId','$rat','$review','$account','$author')";
            if(!mysqli_query($con,$sql)){
                die('Error: '.mysqli_error($con));
            }
        }

    }else{
        // My Profile

        $profile_options='<a href="post.php" class="btn">Post</a> <a href="edit-profile.php" class="btn">Edit</a>';

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
            while ($row = mysqli_fetch_array($posts)){
                $wall = $row['wall'];
                $content= $row['content'];
                $post_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url(';
                $post_view.=$wall.')"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-word">';
                $post_view.=$content.'</div></td></tr></table>';
            }
            // Check point
        }


        // Fetching Reviews
        $sql = "SELECT Profile.name, Profile.profilepic, Review.rating, Review.review FROM `Review` INNER JOIN Profile ON Profile.id = Review.author WHERE Review.account='$myid' ORDER BY Review.Time";
        $reviews = mysqli_query($con,$sql);
        $reviews_view='';
        $count = 0;
        $total = 0;
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
                $reviews_view.=$rating.'.0</div></div><div class="review">';
                $reviews_view.=$rev.'</div></div>';
                $count+=1;
                $total+=$rating;
            }
            $reviews_view.='</main>';
            $avg_rating=round($total/$count,2);
            $sql= "UPDATE `Profile` SET `rating` = '$avg_rating' WHERE `id`='$account'";
            mysqli_query($con,$sql);
            if(!mysqli_query($con,$sql)){
                die('Error: '.mysqli_error($con));
            }
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
                    <li><a href="../contact.php" class="menu-item">Contact us</a></li>
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
                        <span>CONNECTIONS: <?php echo $projects?></span>
                        <span>RATING: <?php echo $avg_rating?></span>
                    </div>
                    <!-- <button id="connect" class="btn" onclick="runSQL()">Try Connect</button> -->
                    <?php echo $profile_options?>
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
            <?php echo $review_section?>
        </section>
        <script>
            function runSQL() {
                // Value to be passed to the PHP script
                var value = "<?php echo $account?>";
                // Make an AJAX request to the PHP script with the value as a parameter
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response from the PHP script
                        console.log(this.responseText);
                    }
                };
                xhttp.open("GET", "connect.php?acc=" + encodeURIComponent(value), true);
                xhttp.send();
            }

        </script>
    </body>
</html>
<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    unset($_SESSION['inbox']);
    $myid = $_SESSION['user'];
    $navbar='<ul class="nav-menu"><li><a href="../message/" class="menu-item">Chat</a></li>
    <li><a href="../profile/" class="menu-item">Profile</a></li>
    <li><a href="../contact-us/" class="menu-item">Contact Us</a></li>
    <li><a href="../logout/" class="menu-item">Logout</a></li></ul>';

    // Fetch Result
    if ($_POST){
        $query =mysqli_real_escape_string($con,$_POST["search"]);
        $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE Profile.name LIKE '%".$query."%' OR Profile.title LIKE '%".$query."%' LIMIT 25";
        $profiles = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($profiles) > 0)
        {
            while ($row = mysqli_fetch_array($profiles)){
                $author=$row['name'];
                $author_title=$row['title'];
                $acc=$row['id'];
                $author_img=$row['profilepic'];
                $projects=$row['projects'];
                $rating=$row['rating'];

                $prof_view.='<div class="product-listing-m gray-bg"><div class="product-listing-img"><img src="';
                $prof_view.=$author_img.'" class="img-responsive" id="resp-img"></div><div class="product-listing-content"><h5><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="display-name">';
                $prof_view.=$author.'</a></h5><p class="display-title">';
                $prof_view.=$author_title.'</p><ul><li>CONNECTIONS: ';
                $prof_view.=$projects.'</li><li>RATING: ';
                $prof_view.=$rating.'</li></ul><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="btn">View</a></div></div>';
            }
        }
    }else{
        
        // Fetching Profiles
        $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE Profile.id!='$myid' LIMIT 25";
        $profiles = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($profiles) > 0)
        {

            while ($row = mysqli_fetch_array($profiles)){
                $author=$row['name'];
                $author_title=$row['title'];
                $acc=$row['id'];
                $author_img=$row['profilepic'];
                $projects=$row['projects'];
                $rating=$row['rating'];

                $prof_view.='<div class="product-listing-m gray-bg"><div class="product-listing-img"><img src="';
                $prof_view.=$author_img.'" class="img-responsive" id="resp-img"></div><div class="product-listing-content"><h5><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="display-name">';
                $prof_view.=$author.'</a></h5><p class="display-title">';
                $prof_view.=$author_title.'</p><ul><li>CONNECTIONS: ';
                $prof_view.=$projects.'</li><li>RATING: ';
                $prof_view.=$rating.'</li></ul><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="btn">View</a></div></div>';
            }
        }
    }
}
else{
    $navbar='<ul class="nav-menu">
    <li><a href="../home/" class="menu-item">Home</a></li>
    <li><a href="../contact-us/" class="menu-item">Contact Us</a></li>
    <li><a href="../login/" class="menu-item">Login</a></li>
    <li><a href="../register/" class="menu-item">Join</a></li></ul>';
    if ($_POST){
        $query =mysqli_real_escape_string($con,$_POST["search"]);
        $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE Profile.name LIKE '%".$query."%' OR Profile.title LIKE '%".$query."%' LIMIT 25";
        $profiles = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($profiles) > 0)
        {
            while ($row = mysqli_fetch_array($profiles)){
                $author=$row['name'];
                $author_title=$row['title'];
                $acc=$row['id'];
                $author_img=$row['profilepic'];
                $projects=$row['projects'];
                $rating=$row['rating'];

                $prof_view.='<div class="product-listing-m gray-bg"><div class="product-listing-img"><img src="';
                $prof_view.=$author_img.'" class="img-responsive" id="resp-img"></div><div class="product-listing-content"><h5><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="display-name">';
                $prof_view.=$author.'</a></h5><p class="display-title">';
                $prof_view.=$author_title.'</p><ul><li>CONNECTIONS: ';
                $prof_view.=$projects.'</li><li>RATING: ';
                $prof_view.=$rating.'</li></ul><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="btn">Login to View</a></div></div>';
            }
        }
    }else{
        
        // Fetching Profiles
        $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` LIMIT 25";
        $profiles = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($profiles) > 0)
        {

            while ($row = mysqli_fetch_array($profiles)){
                $author=$row['name'];
                $author_title=$row['title'];
                $acc=$row['id'];
                $author_img=$row['profilepic'];
                $projects=$row['projects'];
                $rating=$row['rating'];

                $prof_view.='<div class="product-listing-m gray-bg"><div class="product-listing-img"><img src="';
                $prof_view.=$author_img.'" class="img-responsive" id="resp-img"></div><div class="product-listing-content"><h5><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="display-name">';
                $prof_view.=$author.'</a></h5><p class="display-title">';
                $prof_view.=$author_title.'</p><ul><li>CONNECTIONS: ';
                $prof_view.=$projects.'</li><li>RATING: ';
                $prof_view.=$rating.'</li></ul><a href="../profile/index.php?account=';
                $prof_view.=$acc.'" class="btn">Login to View</a></div></div>';
            }
        }
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
                <form name="search-form" class="search-form" method="post">
                    <input type="text" autocomplete="off" name="search"  id="search" placeholder="Search..." required>
                    <!-- <button type="submit"></button> -->
                </form>
                <?php echo $navbar?>
            </nav>
        </header>
        <section id="listing" class="listing">
            <?php echo $prof_view?>
        </section>
    </body>
</html>
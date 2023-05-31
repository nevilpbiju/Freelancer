<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    unset($_SESSION['inbox']);
    $myid = $_SESSION['user'];

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
    <body class="home-page">
        <header>
            <nav class="navigation-bar">
                <a href="../app/"><img src="../files/black-logo.png" class="logo"></a>
                <form name="search-form" class="search-form" method="post">
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
        <section id="listing" class="listing">
            <?php echo $prof_view?>
            <!-- <div class="product-listing-m gray-bg">
                <div class="product-listing-img">
                    <img src="https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" class="img-responsive" id="resp-img">  
                </div>
                <div class="product-listing-content">
                    <h5><a href="#" class="display-name">Nevil P Biju</a></h5>
                    <p class="display-title" >Photographer</p>
                    <ul>
                        <li>PROJECTS: 0</li>
                        <li>RATING 0.0</li>
                    </ul>
                    <a href="#" class="btn">Connect</a>
                </div>
            </div> -->
        </section>
    </body>
</html>
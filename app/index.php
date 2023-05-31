<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    unset($_SESSION['inbox']);
    $myid = $_SESSION['user'];

    // Fetching posts
    // SELECT Profile.name, Profile.profilepic, Review.rating, Review.review FROM `Review` INNER JOIN Profile ON Profile.id = Review.author WHERE Review.account='$myid' ORDER BY Review.Time"
    $sql = "SELECT Post.content, Post.wall, Profile.id, Profile.name, Profile.profilepic, Profile.title FROM `Post` JOIN `Profile` ON Profile.id=Post.authorid ORDER BY Post.time DESC LIMIT 10";
    $posts = mysqli_query($con,$sql);
    echo '<script defer>
    function fullText(x) {
        x.style.textOverflow = "unset";
        x.style.whiteSpace="unset";
        x.style.overflow= "visible";
    }
    function normalText(x) {
        x.style.textOverflow = "ellipsis";
        x.style.whiteSpace= "nowrap";
        x.style.overflow= "hidden";
    }
    </script>';
    // $post_view='';
    if(mysqli_num_rows($posts) > 0)
    {
        while ($row = mysqli_fetch_array($posts)){
            $acc = $row['id'];
            $wall = $row['wall'];
            $author=$row['name'];
            $author_title=$row['title'];
            $author_img=$row['profilepic'];
            $content= $row['content'];
            $post_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url(';
            $post_view.=$wall.')"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-details"><img src="';
            $post_view.=$author_img.'" id="freelancer-img"><div id="freelancer-des"><a href="../profile/index.php?account=';
            $post_view.=$acc.'" id="freelancer-name">';
            $post_view.=$author.'</a><div id="freelancer-title">';
            $post_view.=$author_title.'</div></div></div><div id="freelancer-word" onmouseover="fullText(this)" onmouseout="normalText(this)">';
            $post_view.=$content.'</div></td></tr></table>';
        }
    }

    // Fetching Profiles
    $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.description FROM `Profile` WHERE Profile.id!='$myid' LIMIT 10";
    $profiles = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($profiles) > 0)
    {
        while ($row = mysqli_fetch_array($profiles)){
            $wall = "../files/Data.jpg";
            $author=$row['name'];
            $author_title=$row['title'];
            $author_img=$row['profilepic'];
            $acc=$row['id'];
            $content= $row['description'];
            $prof_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url(';
            $prof_view.=$wall.')"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-details"><img src="';
            $prof_view.=$author_img.'" id="freelancer-img"><div id="freelancer-des"><a href="../profile/index.php?account=';
            $prof_view.=$acc.'"id="freelancer-name">';
            $prof_view.=$author.'</a><div id="freelancer-title">';
            $prof_view.=$author_title.'</div></div></div><div id="freelancer-word" onmouseover="fullText(this)" onmouseout="normalText(this)">';
            $prof_view.=$content.'</div></td></tr></table>';
        }
    }

    // Top accounts
    $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.description FROM `Profile` ORDER BY Profile.rating DESC LIMIT 10";
    $profiles = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($profiles) > 0)
    {
        while ($row = mysqli_fetch_array($profiles)){
            $wall = "../files/Data.jpg";
            $author=$row['name'];
            $author_title=$row['title'];
            $author_img=$row['profilepic'];
            $acc=$row['id'];
            $content= $row['description'];
            $rate_prof_view.='<table id="freelancer"><tr><td id="freelancer-bg" style="background-image: url(';
            $rate_prof_view.=$wall.')"></td></tr><tr><td id="freelancer-discription"><div id="freelancer-details"><img src="';
            $rate_prof_view.=$author_img.'" id="freelancer-img"><div id="freelancer-des"><a href="../profile/index.php?account=';
            $rate_prof_view.=$acc.'"id="freelancer-name">';
            $rate_prof_view.=$author.'</a><div id="freelancer-title">';
            $rate_prof_view.=$author_title.'</div></div></div><div id="freelancer-word" onmouseover="fullText(this)" onmouseout="normalText(this)">';
            $rate_prof_view.=$content.'</div></td></tr></table>';
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
        <section id="listing" class="listing">
            <div class="category-table">
                <div class="category-label"></div>
                <div class="category-group">
                <?php echo $post_view?>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/Data.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">SEO</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your SEO</div>
                        </td></tr>
                    </table>

                </div>
            </div>
            <div class="category-table">
                <div class="category-label">Top Rated</div>
                <div class="category-group">
                    <?php echo $rate_prof_view?>
                </div>
            </div>
            <div class="category-table">
                <div class="category-label"></div>
                <div class="category-group">
                    <?php echo $prof_view?>
                </div>
            </div>
        </section>
    </body>
</html>


<!-- <!DOCTYPE html>
    <head>
        <title>SOLOTREFF</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="../navigation.css" rel="stylesheet" type="text/css">

        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script>
            window.addEventListener('load', function() {
                var chatBox = document.getElementById("chat-box");
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        </script>
    </head>
    <body>
        
        <section id="s1" class="app-screen">
            <div id="navbar">
                <img src="../files/icon.png" class="icon">
                <a href="#" class="nav-button"><img src="../files//Home.png" class="nav-logo"></a>
                <a href="../message/" class="nav-button"><img src="../files/message.png" class="nav-logo"></a>
                <a href="../search/" class="nav-button"><img src="../files/connections.png" class="nav-logo"></a>
                <a href="../logout/" class="nav-button"><img src="../files/exit.png" class="nav-logo"></a>
                <a href="../profile/" class="nav-button"><img src="https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" class="nav-logo" id="nav-dp"></a>
            </div>
            <form id="search-bar">
                <input id="search-txt" type="text" autocomplete="off" placeholder="Search">
                <button type="submit" id="search-btn" class="material-symbols-outlined">Search</button>
            </form>
            <section class="slider-container">
                <div class="slider-wrapper">
                    <div class="slider">
                        <img id="slide" src="https://img.freepik.com/free-photo/close-up-color-designer-freelancer-photographer-editing-customer-photo_482257-18769.jpg?w=2000&t=st=1682142427~exp=1682143027~hmac=20532431dd66d1048aaf61845d454c910087f85334232dc6a95db0859e65b1f8" alt="Graphics">
                        <img id="slide" src="https://img.freepik.com/free-photo/close-up-view-male-hand-holding-professional-camera-street_8353-6510.jpg?w=1480&t=st=1682147392~exp=1682147992~hmac=df6e15c1f8bd1022fffaf3379031cefdddd0fb0e331acdb10aff6f6b69a549fe" alt="Graphics">
                        <img id="slide" src="https://img.freepik.com/free-photo/asia-businessmen-businesswomen-meeting-brainstorming-ideas-conducting-business-presentation-project-colleagues-working-together-plan-success-strategy-enjoy-teamwork-small-modern-night-office_7861-2387.jpg?w=1800&t=st=1682147834~exp=1682148434~hmac=69e97d189aaf1566bec8aa85a27a8b043b779ce1115dc8b66cde62f8b8ce97fc" alt="Graphics">
                        <img id="slide" src="https://img.freepik.com/free-photo/close-up-image-programer-working-his-desk-office_1098-18707.jpg?w=1480&t=st=1682147586~exp=1682148186~hmac=bc6e63c524db55a6d530fd538600aa9f3b9de5e513dc9677c10b71f2e8b4bc3f" alt="Graphics">
                    </div>
                </div>
            </section>
            <div class="category-table">
                <div class="category-label">Top Rated</div>
                <div class="category-group">
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/graphic.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/Data.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">SEO</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your SEO</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/ui.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/design.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/pad.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/Data.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Data Analyst</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional Data Analyst</div>
                        </td></tr>
                    </table>
                    
                </div>
            </div>
            <div class="category-table">
                <div class="category-group">
                    <div id="add"><span>Graphic Designers</span><img src="../files/graphical.png"></div>
                </div>
            </div>
            <div class="category-table">
                <div class="category-label"></div>
                <div class="category-group">
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">Graphic Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional graphic designer</div>
                        </td></tr>
                    </table>
                </div>
            </div>
            <div class="category-table">
                <div class="category-label">New</div>
                <div class="category-group">
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/pad.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/ui.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                    <table id="freelancer">
                        <tr><td id="freelancer-bg" style="background-image: url(../files/design.jpg)"></td></tr>
                        <tr><td id="freelancer-discription">
                            <div id="freelancer-details">
                                <img src="../files/person.png" id="freelancer-img">
                                <div id="freelancer-des">
                                    <div id="freelancer-name">Nevil P Biju</div>
                                    <div id="freelancer-title">UI UX Designer</div>
                                </div>         
                            </div>
                            <div id="freelancer-word">I will be your professional UI UX Designer</div>
                        </td></tr>
                    </table>
                </div>
            </div>
            
            <table id="category-table">
                <tr>
                    <td><div id="category"><img src="../files/bird.png"><p>Logo & Branding</p></div></td>
                    <td><div id="category"><img src="../files/ui.png"><p>UI / UX Designer</p></div></td>
                    <td><div id="category"><img src="../files/camera.png"><p>Photographer</p></div></td>
                    <td><div id="category"><img src="../files/ios.png"><p>iOS Developer</p></div></td>
                    <td><div id="category"><img src="../files/Analyst.png"><p>Data Analyst</p></div></td>
                </tr>
                <tr>
                    <td><div id="category"><img src="../files/web.png"><p>Web Developer</p></div></td>
                    <td><div id="category"><img src="../files/tutor.png"><p>Tutor</p></div></td>
                    <td><div id="category"><img src="../files/social.png"><p>Content Creator</p></div></td>
                    <td><div id="category"><img src="../files/SEO.png"><p>SEO</p></div></td>
                    <td><div id="category"><img src="../files/editor.png"><p>Video Editor</p></div></td>
                </tr>
            </table>
        </section>
    </body>
</html> -->
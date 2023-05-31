<?php unset($_SESSION['inbox']); ?>
<!DOCTYPE html>
    <head>
        <title>HOME</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- Section 1 -->
        <section id="s1" class="s">
            <div id="navbar">
                <img src="../files/logo.png" id="logo">
                <ul id="menu">
                    <li><a href="../about">About</a></li>
                    <li><a href="../login">Login</a></li>
                    <li><a href="../register" id="join-btn">Join</a></li>
                </ul>
            </div>
            <div id="search-area">
                <form name="search-form" method="post" action="../search/">
                <div id="search-head">Find the perfect freelancer for your business</div>
                <input type="text" autocomplete="off" name="search" placeholder="Try 'graphic designer'" id="search-text" class="search-value" required/>
                <button id="search-btn">Search</button>
                </form>
                <div id="quotes">“Develop an Attitude of Gratitude. Say Thank You to everyone you meet, for everything they do for you”<p id="author">-- Brian Tracy</p></div>
            </div>
            <img src="../files/laptop-graphics.png" id="home-graphics">
        </section>
        
        
        <!-- Section 2 -->
        <section id="s1" class="s">
            <div id="section-head">Browse by Category</div>
            <table id="category-table">
                <tr>
                    <td><div id="category"><img src="../files/bird.png" onclick="redirect()"><p>Logo & Branding</p></div></td>
                    <td><div id="category"><img src="../files/ui.png" onclick="redirect()"><p>UI / UX Designer</p></div></td>
                    <td><div id="category"><img src="../files/camera.png" onclick="redirect()"><p>Photographer</p></div></td>
                    <td><div id="category"><img src="../files/ios.png" onclick="redirect()"><p>iOS Developer</p></div></td>
                    <td><div id="category"><img src="../files/Analyst.png" onclick="redirect()"><p>Data Analyst</p></div></td>
                </tr>
                <tr>
                    <td><div id="category"><img src="../files/web.png" onclick="redirect()"><p>Web Developer</p></div></td>
                    <td><div id="category"><img src="../files/tutor.png" onclick="redirect()"><p>Tutor</p></div></td>
                    <td><div id="category"><img src="../files/social.png" onclick="redirect()"><p>Content Creator</p></div></td>
                    <td><div id="category"><img src="../files/SEO.png" onclick="redirect()"><p>SEO</p></div></td>
                    <td><div id="category"><img src="../files/editor.png" onclick="redirect()"><p>Video Editor</p></div></td>
                </tr>
            </table>
        </section>
        <script>
            function redirect(){
                window.location.href = "../search/";
            }
        </script>
    </body>
</html>
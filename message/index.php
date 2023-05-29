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

        <script>
            window.addEventListener('load', function() {
                var chatBox = document.getElementById("chat-box");
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        </script>
    </head>
    <body>
        <!-- APP -->
        <section id="s1" class="app-screen">
        <header>
            <nav class="navigation-bar">
                <a href="../app/"><img src="../files/black-logo.png" class="logo"></a>
                <!-- <form name="search-form" class="search-form" method="post" action="../search/">
                    <input type="text" autocomplete="off" name="search"  id="search" placeholder="Search..." required>
                    <button type="submit"></button>
                </form> -->
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
            <table>
                <tr>
                    <td id="list-pos">
                        <input type="text" placeholder="Search..." id="search-text"/>
                        <button id="search-btn" hidden>Search</button>
                        <table id="name-list">
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                            <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <span>Name</span>
                            </td></tr>
                        </table>
                    </td>
                    <td id="chat-area">
                        <div id="title">
                            <img src="../files/person.png" alt=" " onclick="" class="dp">
                            <div class="details">
                                <span>Name</span>
                            </div>
                        </div>
                        <div id="chat-box">
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHai</div></div>
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="outgoing"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHaiHai</div></div>
                            <div class="incoming"><div class="message">HaiHaiHaiHaiHaiHai</div></div>
                        </div>
                        <form class="input-area" autocomplete="off" method="post">
                            <!-- <input type="text" name="sender" value="<?php echo $user ?>" hidden required>
                            <input type="text" name="guest" value="<?php echo $guest ?>" hidden required> -->
                            <input type="text" placeholder="Type a message..." name="msg" id="send-text" maxlength="250" required>
                            <button type="submit" id="send-btn">▶</button>
                        </form>
                    </td>
                    <td id="default-chat">
                        <img src="../files/communication.png">
                    </td>
                </tr>
            </table>
        </section>
    </body>
</html>
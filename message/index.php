<!DOCTYPE html>
    <head>
        <title>SOLOTREFF</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="../navigation.css" rel="stylesheet" type="text/css">

        <link rel="icon" href="../files/icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
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
            <div id="navbar">
                <img src="../files/icon.png" class="icon">
                <a href="../app/" class="nav-button"><img src="../files//Home.png" class="nav-logo"></a>
                <a href="#" class="nav-button"><img src="../files/message.png" class="nav-logo"></a>
                <a href="../search/" class="nav-button"><img src="../files/connections.png" class="nav-logo"></a>
                <a href="../logout/" class="nav-button"><img src="../files/exit.png" class="nav-logo"></a>
                <a href="../profile/" class="nav-button"><img src="https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" class="nav-logo" id="nav-dp"></a>
            </div>
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
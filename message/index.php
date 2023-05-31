<?php
    include '../config.php';
    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: ../login/");
    }

    if($_POST){
        $ciphering ="AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $myId=$_SESSION['user'];
        $message =mysqli_real_escape_string($con,$_POST["msg"]);
        $encryptionKey = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),1,10);
        $encryptedMsg = openssl_encrypt($message, $ciphering, $encryptionKey,$options,$encryption_iv);
        $encryptedMsg .= $encryptionKey;
        $inbox =mysqli_real_escape_string($con,$_POST["inbox"]);
        $gid =mysqli_real_escape_string($con,$_POST["rec"]);
        $sql="INSERT INTO `Chat`(`inboxid`, `sender`, `receiver`, `msg`) VALUES ('$inbox','$myId','$gid','$encryptedMsg')";
        if(!mysqli_query($con,$sql)){
            die('Error: '.mysqli_error($con));
        }
    }
 ?>
    

<!DOCTYPE html>
    <head>
        <script></script>
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

        <!-- AJAX and jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
    </head>
    <body id="messageBody">
        <!-- APP -->
        <section id="s1" class="app-screen">
        <header>
            <nav class="navigation-bar shadowed">
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
            <table>
                <tr>
                    <td id="list-pos">
                        <input type="text" placeholder="Search..." id="search-text" name="query">
                        <!-- <input type="text" placeholder="Search..." id="search-text" name="query"/>
                        <button id="search-btn" name="search" hidden>Search</button> -->
                        <table id="name-list">
                            <!-- <tr><td id="chat-person">
                                <img src="../files/person.png" id="p-dp">
                                <button onclick=refreshContainer('id')>Name</button>
                            </td></tr> -->
                        </table>
                    </td>
                    <td id="chat-area">
                        <!-- <div id="title">
                            <img src="../files/person.png" alt=" " onclick="" class="dp">
                            <div class="details">
                                <span>Name</span>
                            </div>
                        </div> -->
                        <!-- <div id="chat-box">
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
                        </div> -->
                        <!-- <form class="input-area" autocomplete="off" method="post" id="chatForm" onclick="">
                            <input type="text" placeholder="Type a message..." name="msg" id="send-text" maxlength="250" required>
                            <input type="text" name="sender" hidden required>
                            <input type="text" name="receiver" hidden required>
                            <button type="submit" id="send-btn">▶</button>
                        </form> -->
                    </td>
                    
                    <td id="default-chat">
                        <img src="../files/communication.png">
                    </td>
                </tr>
            </table>
            <?php

if(isset($_SESSION['inbox'])){
    $inb=$_SESSION['inbox'];
    echo '
    <script>
    function refreshContainer(id) {
        $("#chat-area").load("talk.php?inbox=" + id);
        console.log("JavaScript function executed!");
    }
    refreshContainer("'.$inb.'");
    setInterval(function() {
        refreshContainer("'.$inb.'");
    }, 10000);
    </script>';
}
            ?>
        </section>
        <script>
            function sendMessage(){
                $('#messageBody').on('change', function(e) {
                    // Prevent form submission by the browser
                    e.preventDefault();
                    // Rest of the logic
                });
            }
            function refreshContainer(id) {
                $('#chat-area').load('talk.php?inbox=' + id);
            }

            var chat = document.getElementById('chatForm')
            // chat.addEventListener()
            // .addEventListener('onClick', () =>  {
                // document.getElementById('messageBody').preventDefault();
            // });
            $(document).ready(function(){
                // $("#messageBody").submit(function(e) {
                //     e.preventDefault();
                // });
                load_data();
                function load_data(query) {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: {query: query},
                        success: function(data) {
                            $('#name-list').html(data);
                        }
                    });
                }
                $('#search-text').on('keyup', function() {
                    var search = $(this).val();
                    if (search !== '') {
                        load_data(search);
                    } else {
                        load_data();
                    }
                });
                setInterval(function() {
                    load_data();
                }, 20000);
            });
        </script>
        
    </body>
</html>
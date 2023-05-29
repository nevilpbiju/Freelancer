<?php
    include '../config.php';

    session_start();

    if(isset($_SESSION['admin'])){
        $myid = $_SESSION['admin'];
        $sql = "SELECT * from `mail`";
        $mails = mysqli_query($con,$sql);
        $mail_view='';
        while ($row = mysqli_fetch_array($mails)) {
            $name = $row['name'];
            $email = $row['email'];
            $msg = $row['msg'];
            $mail_view.='<tr><td>'.$name.'</td><td>'.$email.'</td><td>'.$msg.'</td><tr>';
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
    <body class="admin-page">
        <header>
            <nav class="navigation-bar">
                <a href="../app/"><img src="../files/black-logo.png" class="logo"></a>
                <form name="search-form" class="search-form" method="post" action="../search/">
                    <input type="text" autocomplete="off" name="search"  id="search" placeholder="Search..." required>
                </form>
                <ul class="nav-menu">
                    <li><a href="../logout/" class="menu-item">Logout</a></li>
                </ul>
            </nav>
        </header>
        <section class="mails">
            <table>
                <tr><th>Name</th><th>Email</th><th>Message</th></tr>
                <?php echo $mail_view?>
                <!-- <tr><td>Nevil</td><td>rjkkrgbge</td><td>ergergggegee</td></tr> -->
            </table>
        </section>
    </body>
</html>

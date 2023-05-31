<?php
include '../config.php';

session_start();

if(isset($_SESSION['user'])){
    
    $myid = $_SESSION['user'];
    $acc = $_GET['acc'];
    function generateId() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 25; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    do{
        $connId = generateId();
        $sql = "SELECT * FROM `Connection` WHERE `id` = '$connId'";
        $revs=mysqli_query($con,$sql);
    }while(mysqli_num_rows($revs)>0);

    // Create connection
    $sql= "INSERT INTO `Connection`(`id`, `user1`, `user2`) VALUES ('$connId','$myid','$acc')";
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    }

    // Create Inbox
    $sql= "INSERT INTO `Inbox`(`id`, `userid`, `guestid`) VALUES ('$connId','$myid','$acc')";
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    }
    
    // Get connections
    $sql = "SELECT `projects` from `Profile` where `id`='$acc'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $c1 = $row['projects'];
    }

    $sql = "SELECT `projects` from `Profile` where `id`='$myid'";
    $profile = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($profile)) {
        $c2 = $row['projects'];
    }

    $c1+=1;
    $c2+=1;

    // Update Connections
    $sql="UPDATE `Profile` SET `projects`='$c1' WHERE `id` = '$acc'";
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    }
    $sql="UPDATE `Profile` SET `projects`='$c2' WHERE `id` = '$myid'";
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    }

}else{
    header("Location: ../login/");
}


?>

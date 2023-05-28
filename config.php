<?php
    ob_start();
    $host = 'localhost';
    $database = 'SoloTreff';
    $username_server = 'root';
    $password_server = '';
    $con = mysqli_connect($host,$username_server,$password_server,$database);
    if(!$con){
        header("Location: ../login/");
        die("Connection failed: ".mysqli_connect_errno());
    }
    // $sql="CREATE TABLE IF NOT EXISTS `Profile` (`id` VARCHAR(50) NOT NULL , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(100) NOT NULL , `phone` VARCHAR(50) NULL , `location` VARCHAR(50) NULL , `profilepic` TEXT NOT NULL , `title` VARCHAR(25) NOT NULL , `linkedin` TEXT NULL , `socialmedia` TEXT NULL , `projects` INT NOT NULL , `rating` DOUBLE NOT NULL , `description` VARCHAR(150) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`Post` (`id` VARCHAR(50) NOT NULL , `content` VARCHAR(100) NOT NULL , `wall` TEXT NOT NULL , `authorid` VARCHAR(50) NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`Review` (`id` VARCHAR(50) NOT NULL , `rating` DOUBLE NOT NULL , `review` VARCHAR(100) NOT NULL , `account` VARCHAR(50) NOT NULL , `author` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`Inbox` (`id` VARCHAR(50) NOT NULL , `userid` VARCHAR(50) NOT NULL , `guestid` VARCHAR(50) NOT NULL , `lastmsg` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`Chat` (`id` INT NOT NULL AUTO_INCREMENT , `inboxid` VARCHAR(50) NOT NULL , `sender` VARCHAR(50) NOT NULL , `receiver` VARCHAR(50) NOT NULL , `msg` VARCHAR(200) NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`Connection` (`id` VARCHAR(50) NOT NULL , `user1` VARCHAR(50) NOT NULL , `user2` VARCHAR(50) NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`), UNIQUE (`user1`, `user2`)) ENGINE = InnoDB; ";
    // mysqli_query($con,$sql);
    // $sql="CREATE TABLE `SoloTreff`.`mail` (`id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(50) NOT NULL , `name` VARCHAR(50) NOT NULL , `msg` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
    // mysqli_query($con,$sql);
     
?>
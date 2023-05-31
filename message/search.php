<?php
    include '../config.php';
    session_start();

    if(isset($_SESSION['user'])){
        $myid = $_SESSION['user'];
        $guest_list='';
        if(isset($_POST["query"])){
    	    $query = mysqli_real_escape_string($con, $_POST["query"]);
            $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE Profile.name LIKE '%".$query."%' AND id!='$myid'";
            $chats2 = mysqli_query($con,$sql);
            if(mysqli_num_rows($chats2) > 0)
            {
                $guest_list='';
                while($row = mysqli_fetch_array($chats2))
                {
                    $gid=$row['id'];
                    $guest_name=$row['name'];
                    $guest_pic=$row['profilepic'];
                    $sql = "SELECT * FROM `Connection` WHERE (user1='$myid' AND user2='$gid') OR (user1='$gid' AND user2='$myid') ";
                    $conns = mysqli_query($con,$sql);
                    if(mysqli_num_rows($conns) == 0)
                    {
                        $guest_list.='<tr><td id="chat-person"><img src="';
                        $guest_list.=$guest_pic.'" id="p-dp"><a href="../profile/index.php?account=';
                        $guest_list.=$gid.'"class="trans-btn">';
                        $guest_list.=$guest_name.' </a></td></tr>';
                    }
                    else{
                        while ($itr = mysqli_fetch_array($conns)){
                            $id=$itr['id'];
                        }
                        $guest_list.='<tr><td id="chat-person"><img src="';
                        $guest_list.=$guest_pic.'" id="p-dp"><button onclick=refreshContainer("'.$id.'") class="trans-btn">';
                        $guest_list.=$guest_name.' </button></td></tr>';
                    }
                }
                echo $guest_list;
            }
            else{
                echo '<div class="end-line">---------------------------</div>';
            }


        }
        else{
    	    // Fetching Profiles
            $sql = "SELECT id, userid, lastmsg FROM `Inbox` WHERE guestid='$myid' ORDER BY lastmsg DESC";
            $chats1 = mysqli_query($con,$sql);

            if(mysqli_num_rows($chats1) > 0)
            {
                while ($row = mysqli_fetch_array($chats1)){
                    $id=$row['id'];
                    $guest= $row['userid'];
                    $last_msg=$row['lastmsg'];
                    $sql = "SELECT Profile.id, Profile.name, Profile.profilepic FROM `Profile` WHERE id='$guest'";
                    $guest_details=mysqli_query($con,$sql);
                    if(mysqli_num_rows($guest_details) > 0){
                        while ($itr = mysqli_fetch_array($guest_details)){
                            $gid=$itr['id'];
                            $guest_name=$itr['name'];
                            $guest_pic=$itr['profilepic'];
                        }
                    }
                    $guest_list.='<tr><td id="chat-person"><img src="';
                    $guest_list.=$guest_pic.'" id="p-dp"><button onclick=refreshContainer("'.$id.'") class="trans-btn">';
                    $guest_list.=$guest_name.' </button></td></tr>';
                }
            }

            $sql = "SELECT id, guestid, lastmsg FROM `Inbox` WHERE userid='$myid' ORDER BY lastmsg DESC";
            $chats1 = mysqli_query($con,$sql);

            if(mysqli_num_rows($chats1) > 0)
            {
                while ($row = mysqli_fetch_array($chats1)){
                    $id=$row['id'];
                    $guest= $row['guestid'];
                    $last_msg=$row['lastmsg'];
                    $sql = "SELECT Profile.id, Profile.name, Profile.profilepic FROM `Profile` WHERE id='$guest'";
                    $guest_details=mysqli_query($con,$sql);
                    if(mysqli_num_rows($guest_details) > 0){
                        while ($itr = mysqli_fetch_array($guest_details)){
                            $gid=$itr['id'];
                            $guest_name=$itr['name'];
                            $guest_pic=$itr['profilepic'];
                        }
                    }
                    $guest_list.='<tr><td id="chat-person"><img src="';
                    $guest_list.=$guest_pic.'" id="p-dp"><button onclick=refreshContainer("'.$id.'") class="trans-btn">';
                    $guest_list.=$guest_name.' </button></td></tr>';
                }
            }
            echo $guest_list;
        }
    }

?>
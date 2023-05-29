<?php
    include 'config.php';

    session_start();
    $user=$_SESSION['user'];
    echo $user;
    // if(isset($_POST["query"]))
    // {
    // 	$search = mysqli_real_escape_string($con, $_POST["query"]);
    // 	$sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE (Profile.name LIKE '%".$search."%' OR Profile.title LIKE '%".$search."%' OR email LIKE '%".$search."%') AND NOT id='$user'";
    // }
    // else
    // {
    //     $sql = "SELECT Profile.id, Profile.name, Profile.profilepic, Profile.title, Profile.projects, Profile.rating FROM `Profile` WHERE Profile.id!='$user' LIMIT 25";
    // }

    // $profiles = mysqli_query($con,$sql);
    
    // if(mysqli_num_rows($profiles) > 0)
    // {
    //     while ($row = mysqli_fetch_array($profiles)){
    //         $author=$row['name'];
    //         $author_title=$row['title'];
    //         $acc=$row['id'];
    //         $author_img=$row['profilepic'];
    //         $projects=$row['projects'];
    //         $rating=$row['rating'];

    //         $prof_view.='<div class="product-listing-m gray-bg"><div class="product-listing-img"><img src="';
    //         $prof_view.=$author_img.'" class="img-responsive" id="resp-img"></div><div class="product-listing-content"><h5><a href="../profile/index.php?account=';
    //         $prof_view.=$acc.'" class="display-name">';
    //         $prof_view.=$author.'</a></h5><p class="display-title">';
    //         $prof_view.=$author_title.'</p><ul><li>PROJECTS: ';
    //         $prof_view.=$projects.'</li><li>RATING: ';
    //         $prof_view.=$rating.'</li></ul><a href="../profile/index.php?account=';
    //         $prof_view.=$acc.'" class="btn">View</a></div></div>';
    //     }
    //     echo $prof_view;
    // }
// $result = mysqli_query($con, $sql);
// if(mysqli_num_rows($result) > 0)
// {
// 	$output .= '<table id="search-result-table"> ';
// 	while($row = mysqli_fetch_array($result))
// 	{
// 		if($user==$row["GuestID"])
// 		{
// 			$out1 = $row["UserID"];
// 			$out2 = $row["LastMsg"];			
// 		}
// 		elseif($user==$row["UserID"]){
// 			$out1 = isset($row["GuestID"]) ? $row["GuestID"]: '';
// 			if($out1==$row["GuestID"]){
// 				$out2 = $row["LastMsg"];
// 			}
// 		}
// 		else{
// 			$out1 = $row["UserID"];
// 			$out2 = $row["Institution"];
// 		}
// 		$guest_id=$out1;
// 		$sql = "SELECT * FROM PublicProfile WHERE UserID='$out1'";
// 		$res = mysqli_query($con, $sql);
// 		while($r = mysqli_fetch_array($res)){
// 			$out1 = $r["Name"];
// 			$outdp = $r["DP"];
// 		}
// 		$output .= '<tr id="search-result-row"> <td><img src="'.$outdp.'" class="dp"></td>
// 		<td id="guest-name"><a href="talk.php?guest='.$guest_id.'">'.$out1.'</a><br><span id="guest-institution">'.$out2.'</span></tr>';
// 	}
//     $output .=' </table>';
	// echo $output;
// }
?>
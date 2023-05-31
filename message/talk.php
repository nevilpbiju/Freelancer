<?php

include '../config.php';
    session_start();
$inbox=$_GET['inbox'];
$_SESSION['inbox']=$inbox;
$ciphering ="AES-128-CTR";
$options = 0;
$encryption_iv = '1234567891011121';

$myid=$_SESSION['user'];
$sql= "SELECT * FROM `Inbox` WHERE id='$inbox'";
$inboxs = mysqli_query($con,$sql);
if(mysqli_num_rows($inboxs) > 0)
{
  while ($row = mysqli_fetch_array($inboxs)) {
    if($row['userid']==$myid){
      $gid=$row['guestid'];      
    }
    else{
      $gid=$row['userid'];
    }
  }
}

$sql = "SELECT `name`, `profilepic` from `Profile` where `id`='$gid'";
$guest = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($guest)) {
    $name = $row['name'];
    $dp = $row['profilepic'];
}
$ouput_view.='<script>
    var chatBox = document.getElementById("chat-box");
    chatBox.scrollTop = chatBox.scrollHeight;
</script>';

$ouput_view.='<div id="title"><img src="'.$dp.'" alt="Nope" onclick="" class="dp"><div class="details"><span>'.$name.'</span></div></div><div id="chat-box">';

$sql = "SELECT `sender`, `msg` FROM `Chat` WHERE `InboxID`= '$inbox';";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result)) {
            $sender = $row['sender'];
            $encryptedMsg = $row['msg'];
            $msglen = strlen($encryptedMsg);
            $decryptionKey = substr($encryptedMsg, $msglen-10);
            $encryptedMsg = substr($encryptedMsg,0,$msglen-10);
            $msg = openssl_decrypt($encryptedMsg, $ciphering, $decryptionKey, $options, $encryption_iv);
            if($sender == $myid){
                $ouput_view .= '<div class="outgoing"><div class="message">'.$msg.'</div></div>';
            }
            else{
                $ouput_view .= '<div class="incoming"><div class="message">'.$msg.'</div></div>';
            }
        }
    }

$ouput_view.='</div><form class="input-area" autocomplete="off" method="post" id="chatForm">
<input type="text" placeholder="Type a message..." name="msg" id="send-text" maxlength="250" required>
<input type="text"  name="inbox" hidden required value="'.$inbox.'">
<input type="text"  name="rec" hidden required value="'.$gid.'">
<button type="submit" onclick="sendMessage()" id="send-btn">▶</button>
</form>';

echo $ouput_view;
?>
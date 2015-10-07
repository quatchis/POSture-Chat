<?php 
include 'head.php';
//////Establish connection from variables declared in head.php
$conn = new mysqli($hostname, $dbuser, $dbpass, $dbselect);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$groupid='WebPOS';
?>


<?php  
if(isset($_GET['send'])=='true'){ 

$chatid = $_GET["chatid"];
$groupid = $groupid;
$message = $_GET["chatmsg"];
$chatgroup = $_GET['chatgroup'];
$chatgroup = str_replace(" ", "-", $chatgroup); 
$_SESSION['chatgroup'] = $chatgroup;
$cgroup = $_GET['chatgroup'];
$date = date("m/d/Y h:i:sa");

if($message!=""){
mysqli_query($conn,"INSERT INTO chat (`chatid`, `groupid`, `message`, `user`, `chatgroup`, `date`)
VALUES ('', '$groupid','$message','$uzer','$chatgroup','$date')");
//echo 'sent message';
echo "
<script>	$('html, body').animate({scrollTop:$(document).height()}, 'slow');</script>;";
}
}
?>

<?php  
if(isset($_GET['changegroup'])=='true'){
$cgroup = $_GET['chatgroup'];
$_SESSION['chatgroup']=$cgroup;
echo '<div class="FadeDiv">Loading Chat...</div>';
}
?>


<?php  
if(isset($_GET['whoschatting'])=='true'){

$cgroup = $_SESSION['chatgroup'];
$chatUsers = "SELECT * FROM chat where chatgroup = '$cgroup' group by user  ";
$result = $conn->query($chatUsers);

echo '<div style="font-size:11px;color:#c7edfc;display:inline-block">Chatting with: </div> ';
if ($result->num_rows > 0) { 
while($row = $result->fetch_assoc()) { 
echo '<div style="font-size:11px;color:#c7edfc;display:inline-block">'.$row['user'].'</div> ';
}
}
}

?>



<?php  
if(isset($_GET['groupslist'])=='true'){

$chatUsers = "SELECT * FROM chat  group by chatgroup order by chatid desc limit 5 ";
$result = $conn->query($chatUsers);

if ($result->num_rows > 0) { 
while($row = $result->fetch_assoc()) { 

echo '<script> 
$(document).ready(function(){
$("#'.$row['chatgroup'].'").click(function() {
var htmlx = $("#'.$row['chatgroup'].'").html();
$(".singlemsg").html("");
$("#chatarea2").load("touch-chat-sql.php?changegroup=true&chatgroup="+htmlx+"");
$("html, body").animate({scrollTop:$(document).height()}, "fast");
$("#chatgroup").val(htmlx);
});
});
</script>';

$chatgroup = isset($_SESSION['chatgroup']);
if($row['chatgroup']==""){$chatroom="Lobby";}else{$chatroom=$row['chatgroup'];}

if($chatgroup!=$chatroom){$color='color:#fff;';}
if($chatgroup==$chatroom){$color='color:#000;';}

echo '<div style="display:inline-block;font-size:11px;background:#c7edfc; '.$color.' padding:5px;border-radius:0px;margin:0px;cursor:pointer" id="'.$chatroom.'">'.$chatroom.'</div>';
unset($color);
unset($chatroom);
unset($chatgroup);
}
}
}

?>




<?php 
if(isset($_GET['receive'])=='true'){

echo '<div style="color:white">';
echo $user .' ('.$groupidGET.')';
echo '<br>';
echo '<br>' ;
echo $date;
echo ' - ';
echo $message; 
echo '</div>'; 



$cgroup = $_SESSION['chatgroup'];
$chatQuery = "SELECT * FROM chat where chatgroup = '$cgroup' ";
$result = $conn->query($chatQuery);

if ($result->num_rows > 0) { 
while($row = $result->fetch_assoc()) { 
$chatid = $row["chatid"];
$groupidGET = $row["groupid"];
$message = $row["message"];

////for injection purposes
$message = preg_replace( '^<a href="(.+)">(.+)</a>^', '<img src="dir/$1">$2', $message );
$message = preg_replace( '^<a href="(.+)">(.+)</a>^', '<img src="dir/$1">$2', $message );
$message = str_replace( 'script', 'js', $message ); 

$user  = $row["user"];
$chatgroup  = $row["chatgroup"];
$_SESSION['chatsession'] = $chatgroup;
$date  = $row["date"];

if($uzer==$user){$chatalign='right;float:right;color:#222;width:90%;border:1px solid #e5f7fd;background:#e5f7fd;margin:5px;border-radius:10px;padding:10 10 10 10;font-size:12px;';}
if($uzer!=$user){$chatalign='left;float:left; width:90%;border:1px solid #c7edfc;background:#c7edfc;margin:5px;border-radius:10px;padding:10 10 10 10;font-size:12px;';}
echo '<div class="singlemsg" style="text-align:'.$chatalign.'">';
echo '<span style="color:#12A5F4;">'.$user .' ('.$groupidGET.')'.'</span>';
echo '<br>'; 
echo $message;  
echo '<br><span style="font-size:10px;">'.$date.'</span>';
echo "</div>
"; 


unset($chatalign);
unset($groupidGET);
}


echo '<div style="color:white">';
echo $user .' ('.$groupidGET.')';
echo '<br>';
echo '<br>';
echo '<br>';
echo $date;
echo ' - ';
echo $message; 
echo '</div>'; 
} else {
echo "No chats, no cat, no hats."; 
}
}
?> 

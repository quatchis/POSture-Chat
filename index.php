<?php 
include 'head.php'; 
  $conn = new mysqli($hostname, $dbuser, $dbpass, $dbselect);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>  

<div class="noselect" id="chatarea2"></div>
<div style="position:fixed;top:0px;left:0px;width:100%;background:#2E4256;">

<div style="padding:10px;color:white">
<?php echo ' <input type="text" placeholder="To create a new chatroom type in the subject..."  id="chatgroup" >';?>
</div>
 
<div id="groupslist" class="noselect"></div>
<div id="whoschatting" ></div>
 
</div>
</div>



<span id="chatarea" style="display:inline-block;width:100%;margin-top:40px; "> 
</span>


<div style="position:fixed;bottom:0px;left:0px;width:100%;background:#2E4256;">
<div style="padding:10px;">
<input type="text" id="chatmsg" autofocus style="width:100%;border-radius:10px;height:40px;border:1px solid #eee;padding:10px;margin-top:0px;font-size:14px;" placeholder="Type your message and hit ENTER to send...">
</div>
</div>



<script> 
$(document).ready(function(){

$('#chatmsg').keypress(function (e) {
  if (e.which == 13) { 
	chatmsg = $('#chatmsg').length ? $('#chatmsg').val() : '';
	chatgroup = $('#chatgroup').length ? $('#chatgroup').val() : '';
	sendMSG($('#chatarea2'));
	    this.value = '';
    return false;    //<---- Add this line
  }
});
function sendMSG($param) {
$("#groupslist").load("touch-chat-sql.php?groupslist=true");

var uriadd = "touch-chat-sql.php?send=true&chatgroup="+chatgroup+"&chatmsg="+chatmsg+"";
var resadd = encodeURI(uriadd);
$("#chatarea2").load(resadd); 
}
}); 




$('#chatgroup').keypress(function (e) {
  if (e.which == 13) { 
	chatgroup = $('#chatgroup').length ? $('#chatgroup').val() : ''; 
	$("#chatarea2").load("touch-chat-sql.php?changegroup=true&chatgroup="+chatgroup+"");
     this.value = '';
	return false;    //<---- Add this line
  }
});





function yourFunction(){
$("#chatarea").load("touch-chat-sql.php?receive=true"); 
		$('html, body').animate({scrollTop:$(document).height()}, 'fast');

    setTimeout(yourFunction,1500);
}
yourFunction();



function yourFunction2(){
$("#whoschatting").load("touch-chat-sql.php?whoschatting=true");
$("#groupslist").load("touch-chat-sql.php?groupslist=true");

    setTimeout(yourFunction2,10000);
}
yourFunction2();

 </script> 
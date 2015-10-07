<?php // error_reporting(0); 
session_start(); 
$dbselect="demo"; 
$dbuser='quatchis'; 
$dbpass='flatron'; 
$hostname='127.0.0.1'; 
$uzer = 'quatchis';
$groupid = 'lanterns';
date_default_timezone_set('Asia/Ho_Chi_Minh'); 

/////////Database fields/////////////////////////////////////////////////////////////////
///INSERT INTO chat (`chatid`, `groupid`, `message`, `user`, `chatgroup`, `date`)
/////////////////////////////////////////////////////////////////////////////////////////
?>
<head>
<title>POSture Chat Beta</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="mobile-web-app-capable" content="yes">
<script type="text/javascript" src="jquery.min.js"></script> 

<style>
body, html{
    height: 100%;
	background:#fff;
	font-family:arial;
	
	   
}
a {font-size:11px;color:#c7edfc;}
body{margin:0}

.noselect{ -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;}
	
	
	#groupslist{
	width:100%;
	background:#E5F7FD;
	border-top:3px solid black;
	border-bottom:3px solid black;
	}
	
	#chatgroup{
	border:0px; 
	text-align:center; 
	background:#fff;
	width:100%;
	color:#12A5F4; 
	padding:5px;
	display:inline-block
	
	}
</style>
 
</head>
<?php
include("dbConnect.inc");

session_start();

$m="Unknown error";
if(!isset($_POST['username'])) $m="Invalid user name\n";
else if(!isset($_POST['password'])) $m="Invalid user password\n";
else if(!isset($_POST['session_token'])) $m="You must activate cookies\n";
else if($_POST['session_token'] != $_SESSION['session_token']) $m="Invalid form submission\n";
else {
	$un = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	
	$q="SELECT id FROM users WHERE username='".$un."'";
	$r=mysqli_query($conn, $q);
	if(mysqli_num_rows($r) > 0) $m="Username already exists. Please choose a different one.";
	else {
		$pw = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		$pw = sha1($pw);
		
		$q="INSERT INTO users (UserName, Password ) VALUES ('".$un."', '".$pw."')";
		$r=mysqli_query($conn, $q);
		if($r==false) $m="Sign up failed.";
		else $m="OK";
	}
} 

echo $m;
?>

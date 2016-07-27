<?php
include("dbConnect.inc");

$m="Failed.";
if(isset($_POST['un'], $_POST['pw'])) {
	$un = filter_var($_POST['un'], FILTER_SANITIZE_STRING);
	$pw = filter_var($_POST['pw'], FILTER_SANITIZE_STRING);
	$pw = sha1($pw);
	
	$q="SELECT id FROM users WHERE BINARY username='".$un."' AND password='".$pw."'";
	$r=mysqli_query($conn, $q);
	if(mysqli_num_rows($r) == 1) {
		session_start();
		$row=mysqli_fetch_row($r);
		$_SESSION['user_id'] = $row[0];		
		$_SESSION['username'] = $_POST['un'];
		mysqli_free_result($r);
		
		$m="OK";
	}
}
usleep(1000*1000);

echo $m;
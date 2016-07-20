<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$id=$_SESSION['user_id'];
	
	include("dbConnect.inc");
	
	$user=0;
	$q="SELECT UserName FROM users WHERE id=".$id;
	$us=mysqli_query($conn, $q);
	if(mysqli_num_rows($us)==1) {
		$u=mysqli_fetch_assoc($us);
		$user=$u['UserName'];
		
		$fileName=$_POST['f'];
		$width=$_POST['w'];
		
		$q="SELECT Height FROM premade WHERE FileName='".$fileName."' AND Width=".$width;
		$hs=mysqli_query($conn, $q);
		if(mysqli_num_rows($hs)!=1) exit();
		$h=mysqli_fetch_assoc($hs);
		$height=$h['Height'];
		
		$videoUID=sha1("webCaster-".$_SESSION['username']."-".$fileName."-".date("Y-m-d H:i:s"));
		
		// Move files to final destination
		mkdir("data/".$user."/done/".$videoUID);
		copy("premade/videos/".$fileName."-".$width.".mp4", "data/".$user."/done/".$videoUID."/video.mp4");
		copy("premade/".$fileName.".png", "data/".$user."/done/".$videoUID.".png");
		
		$q="INSERT INTO projects (UserId, Title, FileName, uid, Width, Height, DisplayAutomatically, ExitOnEnd, ViewRemaining) VALUES ('";
		$q.=$_SESSION['user_id']."', 'Premade video', '".$fileName."', '".$videoUID."', ".$width.", ".$height.", 1, 1, 100)";
		mysqli_query($conn, $q);
		
		mysqli_close($conn);
		
		$rv="OK";
	}
	echo $rv;
} else {
	echo "Login";
}
?>

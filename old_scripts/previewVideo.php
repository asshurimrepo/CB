<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$vid="";
	if(isset($_POST['vid'])) {
		$vid=$_POST['vid'];
		
		include("dbConnect.inc");
		
		$q="SELECT * FROM premade WHERE FileName='".$vid."' AND Width=".$_POST['width'];
		$vs=mysqli_query($conn, $q);
		if(mysqli_num_rows($vs)==1) {
			$v=mysqli_fetch_assoc($vs);
			
			echo "videoPath=premade/videos/".$vid."-".$v['Width'].".mp4\n";
			echo "playerWidth=".$v['Width']."\n";
			echo "playerHeight=".$v['Height']."\n";
		}
	}
} else {
	echo "Login";
}
?>

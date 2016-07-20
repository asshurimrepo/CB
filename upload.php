<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$id=$_SESSION['user_id'];
	
	include("dbConnect.inc");
	
	$rv="OK";
	$user=0;
	$q="SELECT UserName FROM users WHERE id=".$id;
	$us=mysqli_query($conn, $q);
	if(mysqli_num_rows($us)==1) {
		//file_put_contents("data/".$user."/progress.log" , "Uploading file.");
		$u=mysqli_fetch_assoc($us);
		$user=$u['UserName'];
		
		$fileName=str_replace(" ","_",$_FILES['file']['name']);
		$outputWidth=$_POST['outputWidth'];
		if($outputWidth%2>0) $outputWidth--;
		
		move_uploaded_file($_FILES['file']['tmp_name'], "data/".$user."/videos/".$fileName);
		chmod("data/".$user."/videos/".$fileName, 0777);
		
		file_put_contents("data/".$user."/progress.log" , "Initializing processing...");
		exec("./distillVideo ".$user." ".$fileName);
		sleep(1);
		
		file_put_contents("data/".$user."/progress.log" , "Progress");
		exec("./processFrames ".$user." ".$outputWidth." 0");
		
		$frames=scandir("data/".$user."/images");
		
		$maxFrame=count($frames)-2;
		for($i=1; $i<=$maxFrame; $i++) {
			$file=sprintf('%05d', $i).".png";
			$retries=5;
			while(!file_exists("data/".$user."/out/".$file)) {
				exec("./processSingleFrame ".$user." ".$file." ".$outputWidth." 0");
				$retries--;
				if($retries<0) break;
			}
		}
		
		//file_put_contents("data/".$user."/progress.log" , "Reconstructing video");
		$videoUID=sha1("webCaster-".$_SESSION['username']."-".$fileName."-".date("Y-m-d H:i:s"));
		
		// Move files to final destination
		mkdir("data/".$user."/done/".$videoUID);
		exec("./reComposeVideo ".$user." ".$videoUID);
		if(file_exists("data/".$user."/images/00010.png"))
			copy("data/".$user."/out/thumb.png", "data/".$user."/done/".$videoUID.".png");
		
		if(file_exists("data/".$user."/done/".$videoUID."/video.mp4") &&
		   file_exists("data/".$user."/done/".$videoUID.".png")) {
			list($width, $height) = getimagesize("data/".$user."/images/00010.png");
			$height=intval($height*$outputWidth/$width);
			if($height%2>0) $height--;
			$q="INSERT INTO projects (UserId, Title, FileName, uid, MaxFrame, Width, Height, ViewRemaining) VALUES ('";
			$q.=$_SESSION['user_id']."', 'New video', '".$fileName."', '".$videoUID."', ".$maxFrame.", ".$outputWidth.", ".$height.", 100)";
			if(!mysqli_query($conn, $q)) $rv=mysqli_error($conn)."\n".$q."\n";
		} else {
			if(file_exists("data/".$user."/done/".$videoUID))
				rmdir("data/".$user."/done/".$videoUID);
			if(file_exists("data/".$user."/done/".$videoUID.".png"))
				unlink("data/".$user."/done/".$videoUID.".png");
			$rv="An unknown error occured, please try with a different video";
        }
		mysqli_close($conn);
	}
	file_put_contents("data/".$user."/progress.log" , "END");
	echo $rv;
} else {
	echo "Login";
}
?>

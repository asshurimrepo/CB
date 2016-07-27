<?php
session_start();

if($_SESSION['user_id']>0) {
	$id=$_SESSION['user_id'];
	
	include("dbConnect.inc");
	
	$rv="OK";
	$user=0;
	$q="SELECT UserName FROM users WHERE id=".$id;
	$us=mysqli_query($conn, $q);
	if(mysqli_num_rows($us)==1) {
		$u=mysqli_fetch_assoc($us);
		$user=$u['UserName'];
		
		$vid=0;
		if(isset($_POST['vid'])) {
			$vid=$_POST['vid'];
			
			$q="SELECT uid FROM projects WHERE id=".$vid;
			$uids=mysqli_query($conn, $q);
			if(mysqli_num_rows($uids)!=1) $rv="Database error.";
			else {
				$uid=mysqli_fetch_assoc($uids);
				$fileName=$uid['uid'];
				
				$q="DELETE FROM projects WHERE id=".$vid;
				
				$res=mysqli_query($conn, $q);
				if($res===FALSE) $rv="Database error.";
				else {
					$files = glob("data/".$user."/done/".$fileName."/*");
					foreach($files as $file){
						if(is_file($file))
						$res&=unlink($file);
					}
					$res&=rmdir("data/".$user."/done/".$fileName);
					$res&=unlink("data/".$user."/done/".$fileName.".png");
					if(!$res) $rv="Filesystem error.";
				}
			}
		}
	} else $rv="Database error.";
	echo $rv;
	mysqli_close($conn);
}
?>

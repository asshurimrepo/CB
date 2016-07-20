<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$vid=0;
	if(isset($_POST['vid'])) {
		$vid=$_POST['vid'];
		if(isset($_POST['data'])) {
			$data=$_POST['data'];
			
			include("dbConnect.inc");
			
			$q="UPDATE projects SET ";
			$lines=explode("\n", $data);
			for($i=0; $i<count($lines); $i++) {
				if(strpos($lines[$i], "=")<1) continue;
				
				$line=explode("=", $lines[$i]);
				//echo $lines[$i]."<br/>".$line[0]."<br/>".$line[1]."<br/><br/>";
				$line[0]=trim($line[0]);
				$line[1]=trim($line[1]);
				
				if($line[0]=="propertyTitle") $q.="Title='".$line[1]."', ";
				else if($line[0]=="propertyActive") $q.="Active=".$line[1].", ";
				else if($line[0]=="propertyPosition") $q.="Position=".$line[1].", ";
				else if($line[0]=="propertyOffsetX") $q.="OffsetX=".$line[1].", ";
				else if($line[0]=="propertyOffsetY") $q.="OffsetY=".$line[1].", ";
				else if($line[0]=="propertyDisplayAutomatically") $q.="DisplayAutomatically=".$line[1].", ";
				else if($line[0]=="propertyDisplayAfter") $q.="DisplayAfter=".$line[1].", ";
				
				else if($line[0]=="propertyDimmedBG") $q.="DimmedBG=".$line[1].", ";
				else if($line[0]=="propertyGlass") $q.="GlassBG=".$line[1].", ";
				else if($line[0]=="propertyExitOnEnd") $q.="ExitOnEnd=".$line[1].", ";
				
				else if($line[0]=="propertyCookieLife") $q.="CookieLife=".$line[1].", ";
				else if($line[0]=="propertyStopShowingWhen") $q.="StopShowingWhen=".$line[1].", ";
				
				else if($line[0]=="propertyIframeURL") $q.="IframeURL='".mysqli_real_escape_string($conn, $line[1])."', ";
				else if($line[0]=="propertyExtVideoURL") $q.="ExtVideoURL='".$line[1]."', ";
				else if($line[0]=="propertyExtVideoDuration") $q.="ExtVideoDuration=".$line[1].", ";
			}
			$q=substr($q, 0, strlen($q)-2)." WHERE id=".$vid;
			//$rv=$q;
			$rv="OK";
			$q=str_replace("\n,", ",", $q);
			$res=mysqli_query($conn, $q);
			if($res===FALSE) $rv="Properties saving failed.";
			
			mysqli_close($conn);
			
			echo $rv;
		}
	}
} else {
	echo "Login";
}
?>

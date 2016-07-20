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
				
				if($line[0]=="linkURL") $q.="Url='".$line[1]."', ";
				
				else if($line[0]=="textLine1") $q.="TextLine1='".$line[1]."', ";
				else if($line[0]=="textLine2") $q.="TextLine2='".$line[1]."', ";
				else if($line[0]=="textPosition") $q.="TextPosition=".$line[1].", ";
				else if($line[0]=="textShowSec") $q.="TextShowSec=".$line[1].", ";
				else if($line[0]=="textShowDuration") $q.="TextShowDuration=".$line[1].", ";
				else if($line[0]=="textStyling") $q.="TextStyling=\"".$line[1]."\", ";
				
				else if($line[0]=="phoneNumber") $q.="PhoneNumber='".$line[1]."', ";
				else if($line[0]=="phonePosition") $q.="PhonePosition=".$line[1].", ";
				else if($line[0]=="phoneShowSec") $q.="PhoneShowSec=".$line[1].", ";
				else if($line[0]=="phoneShowDuration") $q.="PhoneShowDuration=".$line[1].", ";
				else if($line[0]=="phoneStyling") $q.="PhoneStyling=\"".$line[1]."\", ";
				
				else if($line[0]=="buttonLabel") $q.="ButtonLabel='".$line[1]."', ";
				else if($line[0]=="buttonCode") $q.="ButtonCode='".$line[1]."', ";
				else if($line[0]=="buttonPosition") $q.="ButtonPosition=".$line[1].", ";
				else if($line[0]=="buttonShowSec") $q.="ButtonShowSec=".$line[1].", ";
				else if($line[0]=="buttonShowDuration") $q.="ButtonShowDuration=".$line[1].", ";
				else if($line[0]=="buttonStyling") $q.="ButtonStyling=\"".$line[1]."\", ";
				
				else if($line[0]=="formCode") $q.="FormCode='".$line[1]."', ";
				else if($line[0]=="formPosition") $q.="FormPosition=".$line[1].", ";
				else if($line[0]=="formShowSec") $q.="FormShowSec=".$line[1].", ";
				else if($line[0]=="formShowDuration") $q.="FormShowDuration=".$line[1].", ";
			}
			$q=substr($q, 0, strlen($q)-2)." WHERE id=".$vid;
			//$rv=$q;
			$rv="OK";
			$res=mysqli_query($conn, $q);
			if($res===FALSE) $rv="Actions saving failed.";
			
			mysqli_close($conn);
			
			echo $rv;
		}
	}
} else {
	echo "Login";
}
?>

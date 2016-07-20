<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$vid=0;
	if(isset($_POST['vid'])) {
		$vid=$_POST['vid'];
		
		include("dbConnect.inc");
		$q="SELECT * FROM projects WHERE id=".$vid;
		$prjs=mysqli_query($conn, $q);
		if(mysqli_num_rows($prjs)==1) {
			$prj=mysqli_fetch_assoc($prjs);
			
			$rslt="title=".$prj['Title']."\n";
			
			$rslt.="linkURL=".$prj['Url']."\n";
			
			$rslt.="textLine1=".$prj['TextLine1']."\n";
			$rslt.="textLine2=".$prj['TextLine2']."\n";
			$rslt.="textPosition=".$prj['TextPosition']."\n";
			$rslt.="textShowSec=".$prj['TextShowSec']."\n";
			$rslt.="textShowDuration=".$prj['TextShowDuration']."\n";
			$rslt.="textStyling=".$prj['TextStyling']."\n";
			
			$rslt.="phoneNumber=".$prj['PhoneNumber']."\n";
			$rslt.="phonePosition=".$prj['PhonePosition']."\n";
			$rslt.="phoneShowSec=".$prj['PhoneShowSec']."\n";
			$rslt.="phoneShowDuration=".$prj['PhoneShowDuration']."\n";
			$rslt.="phoneStyling=".$prj['PhoneStyling']."\n";
			
			$rslt.="buttonLabel=".$prj['ButtonLabel']."\n";
			$rslt.="buttonCode=".$prj['ButtonCode']."\n";
			$rslt.="buttonPosition=".$prj['ButtonPosition']."\n";
			$rslt.="buttonShowSec=".$prj['ButtonShowSec']."\n";
			$rslt.="buttonShowDuration=".$prj['ButtonShowDuration']."\n";
			$rslt.="buttonStyling=".$prj['ButtonStyling']."\n";
			
			$rslt.="formCode=".$prj['FormCode']."\n";
			$rslt.="formShowSec=".$prj['FormShowSec']."\n";
			$rslt.="formShowDuration=".$prj['FormShowDuration']."\n";
			
			echo $rslt;
		}
	}
} else {
	echo "Login";
}
?>

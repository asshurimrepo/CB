<?php
include("global.inc");

$uid="";
$view=0;
if(isset($_POST['uid'])) {
	$uid=$_POST['uid'];
	$view=$_POST['view'];
	
	header("Access-Control-Allow-Origin: *");
	
	include("dbConnect.inc");
	
	$q="SELECT * FROM projects WHERE uid='".$uid."' AND Active>0 AND ViewRemaining>0";
	$vs=mysqli_query($conn, $q);
	if(mysqli_num_rows($vs)==1) {
		$v=mysqli_fetch_assoc($vs);
		
		$q="UPDATE projects SET ViewCount=ViewCount+1, ViewRemaining=ViewRemaining-1 WHERE uid='".$uid."'";
		mysqli_query($conn, $q);
		
		$q="SELECT UserName FROM users WHERE id=".$v['UserId'];
		$us=mysqli_query($conn, $q);
		if(mysqli_num_rows($us)==1) {
			$u=mysqli_fetch_assoc($us);
			$user=$u['UserName'];
			
			$d=new DateTime(date("Y-m-d H:i:s"));
			$stamp=$d->format("YmdH");
			$validityCode=sha1($_VALIDATION_PREFIX.$stamp);
			echo "user=".$user."\n";
			echo "validityCode=".$validityCode."\n";
			echo "displayAfter=".$v['DisplayAfter']."\n";
			echo "dimmedBG=".$v['DimmedBG']."\n";
			echo "displayAutomatically=".$v['DisplayAutomatically']."\n";
			echo "cookieLife=".$v['CookieLife']."\n";
			echo "stopShowingWhen=".$v['StopShowingWhen']."\n";
			
			echo "iframeURL=".$v['IframeURL']."\n";
			echo "extVideoURL=".$v['ExtVideoURL']."\n";
			echo "extVideoDuration=".$v['ExtVideoDuration']."\n";
			
			echo "videoPath=data/".$user."/done/".$uid."/video.mp4\n";
			echo "playerWidth=".$v['Width']."\n";
			echo "playerHeight=".$v['Height']."\n";
			echo "playerPos=".$v['Position']."\n";
			echo "playerOffsX=".$v['OffsetX']."\n";
			echo "playerOffsY=".$v['OffsetY']."\n";
			echo "playerGlassBG=".$v['GlassBG']."\n";
			echo "playerExitOnEnd=".$v['ExitOnEnd']."\n";
			
			echo "playerURL=".$v['Url']."\n";
			echo "playerTxtLine1=".$v['TextLine1']."\n";
			echo "playerTxtLine2=".$v['TextLine2']."\n";
			echo "playerTxtStyle=".$v['TextStyling']."\n";
			echo "playerTxtPos=".$v['TextPosition']."\n";
			echo "playerTxtStart=".$v['TextShowSec']."\n";
			echo "playerTxtEnd=".($v['TextShowSec']+$v['TextShowDuration'])."\n";
			
			echo "playerPhoneNr=".$v['PhoneNumber']."\n";
			echo "playerPhnStyle=".$v['PhoneStyling']."\n";
			echo "playerPhnPos=".$v['PhonePosition']."\n";
			echo "playerPhnStart=".$v['PhoneShowSec']."\n";
			echo "playerPhnEnd=".($v['PhoneShowSec']+$v['PhoneShowDuration'])."\n";
			
			echo "playerBtnLabel=".$v['ButtonLabel']."\n";
			echo "playerBtnCode=".$v['ButtonCode']."\n";
			echo "playerBtnStyle=".$v['ButtonStyling']."\n";
			echo "playerBtnPos=".$v['ButtonPosition']."\n";
			echo "playerBtnStart=".$v['ButtonShowSec']."\n";
			echo "playerBtnEnd=".($v['ButtonShowSec']+$v['ButtonShowDuration'])."\n";
			
			echo "playerFrmCode=".$v['FormCode']."\n";
			echo "playerFrmStart=".$v['FormShowSec']."\n";
			echo "playerFrmEnd=".($v['FormShowSec']+$v['FormShowDuration'])."\n";
		}
	} else {
		echo "SELECT * FROM projects WHERE uid='".$uid."' AND Active>0 AND ViewRemaining>0";
	}
}
?>

<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if($_SESSION['user_id']>0) {
	$vid=0;
	if(isset($_POST['vid'])) {
		$vid=$_POST['vid'];
		
		include("dbConnect.inc");
		include("global.inc");
		$q="SELECT * FROM projects WHERE id=".$vid;
		$prjs=mysqli_query($conn, $q);
		if(mysqli_num_rows($prjs)==1) {
			$prj=mysqli_fetch_assoc($prjs);
			
			$rslt="propertyTitle=".$prj['Title']."\n";
			$rslt.="propertyPlan=".$_PLAN_[$prj['Plan']]."\n";
			$rslt.="propertyActive=".$prj['Active']."\n";
			$rslt.="propertyPosition=".$prj['Position']."\n";
			$rslt.="propertyOffsetX=".$prj['OffsetX']."\n";
			$rslt.="propertyOffsetY=".$prj['OffsetY']."\n";
			$rslt.="propertyDisplayAutomatically=".$prj['DisplayAutomatically']."\n";
			$rslt.="propertyDisplayAfter=".$prj['DisplayAfter']."\n";
			
			$rslt.="propertyDimmedBG=".$prj['DimmedBG']."\n";
			$rslt.="propertyGlass=".$prj['GlassBG']."\n";
			$rslt.="propertyExitOnEnd=".$prj['ExitOnEnd']."\n";
			
			$rslt.="propertyCookieLife=".$prj['CookieLife']."\n";
			$rslt.="propertyStopShowingWhen=".$prj['StopShowingWhen']."\n";
			
			$rslt.="propertyIframeURL=".$prj['IframeURL']."\n";
			$rslt.="propertyExtVideoURL=".$prj['ExtVideoURL']."\n";
			$rslt.="propertyExtVideoDuration=".$prj['ExtVideoDuration']."\n";
			
			echo $rslt;
		}
	}
} else {
	echo "Login";
}
?>

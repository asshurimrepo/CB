<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

$user="";
$user_id=0;
if(isset($_SESSION['username'])) {
	$user=$_SESSION['username'];
	$user_id=$_SESSION['user_id'];
} else {
	$session_token = crypt(uniqid('webcaster', true));
	$_SESSION['session_token'] = $session_token;
}

if($user!="") {
	if(!file_exists("data/".$user."/videos")) {
		mkdir("data/".$user);
		mkdir("data/".$user."/videos");
		mkdir("data/".$user."/images");
		mkdir("data/".$user."/out");
		mkdir("data/".$user."/done");
		mkdir("data/".$user."/tmp");
	}
	
	$act="";
	if(isset($_POST['act'])) $act=$_POST['act'];
	
	if($act=="logout") {
		session_unset();
		session_destroy();
		$user="";
		//echo "<script>window.location.href='';</script>";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">

    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">
    
<!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->
<title>CasterBuddy</title>
<script>
var xhr;
var user='<?php echo $user; ?>';
var targetWidth=400;

function log(param){
    setTimeout(function(){
        throw new Error("Debug: "+param)
    },0)
}

function logout() {
	document.getElementById("act").value="logout";
	document.getElementById("upldr").submit();
}
</script>
</head>
<body style='text-align: center;'>
<div style='width: 100%; max-width: 1280px; margin: 0 auto; background-color: #fdfdfd;'>
	
<!-- Header -->
<div class="row" style="padding: 0px; margin: 0 auto; background-image: url('images/headerBG.png'); background-repeat: repeat-x; background-size: contain; max-width: 1280px; height: 110px;">
<div class='col-6 col-m-12' style='padding: 0px; margin: 0px;'><img src='images/logo.png'/></div>

<!-- Menu -->
<div class='col-1 col-m-2' style='padding: 0px; margin: 0px;'><span class='menu'><br/><br/>Home&nbsp;</span></div>
<div class='col-1 col-m-2' style='padding: 0px; margin: 0px;'><span class='menu'><br/><br/>Work&nbsp;</span></div>
<div class='col-1 col-m-2' style='padding: 0px; margin: 0px;'><span class='menu'><br/><br/>Services&nbsp;</span></div>
<div class='col-1 col-m-2' style='padding: 0px; margin: 0px;'><span class='menu'><br/><br/>Contact&nbsp;</span></div>
<!-- <div class='col-1 col-m-2' style='padding: 0px; margin: 0px;'><span class='menu' style='border-right: none;'><br/><br/>Login&nbsp;</span></div> -->
<div class='col-12 col-m-12' style='padding: 0px; margin: 0px; position:relative;'>
	<img class='fixed-height' src='images/yellowLine.png'/>
	<!-- <img class='fixed-height1' style='width: 100px;' id='mark' src='images2/mark.png'/> -->
</div>

</div>
<div style="clear: both;"></div>

<form id='upldr' name='upldr' method='POST'>

<?php
if($user=="") {
	include("login.inc");
	include("main.inc");
} else {
	include("dbConnect.inc");
	
	include("myvideos.inc");
	
	// Layers
	include("upload.inc");
	include("properties.inc");
	include("actions.inc");
	include("embed.inc");
}
?>

</form>

<?php include("footer.inc"); ?>

</div>
</body>
</html>

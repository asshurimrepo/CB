<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

if(isset($_SESSION['user_id'])) {
	$id=$_SESSION['user_id'];
	
	include("dbConnect.inc");
	
	$user=0;
	$q="SELECT UserName FROM users WHERE id=".$id;
	$us=mysqli_query($conn, $q);
	if(mysqli_num_rows($us)==1) {
		$user=$_SESSION['username'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>CasterBuddy</title>
<script>
var previewW=300;

function logout() {
	document.getElementById("act").value="logout";
	document.getElementById("upldr").submit();
}

function grabitCallback() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(r=="OK") alert("Added successfully!"); else alert("Grab failed!");
	}
}

var xhr;
function grabit(f, w) {
	var fd = new FormData();
	fd.append("f", f);
	fd.append("w", w);
	
	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", grabitCallback, false);

	xhr.open("POST", "grabPremade.php", true);
	xhr.send(fd);
}
</script>
</head>
<body style='text-align: center;'>
<form id='upldr' name='upldr' method='POST' action='/index.php'>
<input type='hidden' id='act' name='act' value='upload'>
</form>

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

<div style='margin-top: 20px;'>User: <b><?php echo $user; ?></b>&emsp;<a href='javascript: logout();'>[Disconnect]</a></div>
<br />

<?php
	$q="SELECT id, Title, FileName, Width, Height FROM premade WHERE Width=400";
	$ps=mysqli_query($conn, $q);
	
	$n=1;
	while($p=mysqli_fetch_assoc($ps)) {
		echo "<div id='tr".$n."' class='col-3 col-m-12 vignette'>\n";
		echo $p['Title']."<br/>\n";
		echo "<img style='margin-top: 8px; margin-bottom: 8px;' src='premade/".$p['FileName'].".png' class='thumb' onClick=\"viewVideo('".$p['FileName']."', 400);\", title='View'><br/>\n";
		
		echo "<select id='size' onChange='previewW=this.value;'><option value='200'>Small</option><option value='300' selected>Medium</option><option value='400'>Large</option></select>&ensp;\n";
		echo "<a href='javascript: void(0);' onClick=\"viewVideo('".$p['FileName']."', previewW);\" title='Preview video'><img src='images/view.png' style='vertical-align: text-bottom;'/></a>&ensp;\n";
		echo "<a href='javascript: void(0);' onClick=\"grabit('".$p['FileName']."', previewW);\" title='Add video to project'><img src='images/add.png' style='vertical-align: text-bottom;'/></a>\n";
		echo "</div>\n";
		
		$n++;
	}
?>

</div>
<div style="clear: both;"></div>

<br />

<div style='text-align: center;'>
	<a href='<?php echo $_ROOT_; ?>'>&nbsp;Back to videos</a>
</div>
<br/>

<?php include("footer.inc"); ?>

<script src='previewer.js'></script>

</body>
</html>

<?php
} else {
	header("Location: ".$_ROOT_);
	exit();
}
?>

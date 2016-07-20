<?php
include("global.inc");

$uid="";
$closeOnEnd=0;
$validityCode="";

if(!isset($_GET['uid'])) exit();
else if(!isset($_GET['closeOnEnd'])) exit();
else if(!isset($_GET['validityCode'])) exit();

$uid=$_GET['uid'];
$closeOnEnd=$_GET['closeOnEnd'];
$validityCode=$_GET['validityCode'];

$d=new DateTime(date("Y-m-d H:i:s"));
$stamp=$d->format("YmdH");
$v1=sha1($_VALIDATION_PREFIX.$stamp);
$d=date_sub($d, date_interval_create_from_date_string('1 hour'));
$stamp=$d->format("YmdH");
$v2=sha1($_VALIDATION_PREFIX.$stamp);
//echo $validityCode."</br>".$v1."</br>".$v2."</br>";
if($validityCode!=$v1 && $validityCode!=$v2) exit();

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
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>CasterBuddy test</title>
<script>
var timer;
var outputCanvas;
var output;
var bufferCanvas;
var buffer;
var vPlayer;
var w=<?php echo $v['Width']; ?>;
var h=<?php echo $v['Height']; ?>;
var closeOnEnd=<?php echo ($closeOnEnd==1 ? 'true' : 'false'); ?>;

var tenths=1;
var frstfrm=true;
var dy=0;
function _processFrame() {
	buffer.drawImage(vPlayer, 0, 0);
	
	var	image=buffer.getImageData(0, 0, w, h-dy-7);
	var alpha=buffer.getImageData(0, h-dy, w, h-dy-7);
	var	imageData=image.data;
	var	alphaData=alpha.data;
	
	if(frstfrm) {
		if(navigator.userAgent.toLowerCase().indexOf('firefox')<0) {
			if(alphaData[w*4]<50) dy=6;
		}
      frstfrm=false;
	} else {
		var strt=w*0+3;
		var len=imageData.length;
		for(var i=strt; i<len; i+=4) imageData[i]=alphaData[i-1];
	
		output.putImageData(image, 0, 0, 0, 0, w, h-6);
    }
	
	if((tenths++)%10==0) parent.postMessage("playing", "*");
}

function startProcessing() {
	timer = setInterval(_processFrame, 100);
}

function stopProcessing() {
	clearInterval(timer);
	if(closeOnEnd) parent.postMessage("finished", "*");
}

function startPlaying() {
	outputCanvas.setAttribute("width", w);
	outputCanvas.setAttribute("height", h);
  
	setTimeout(function(){ vPlayer.play(); }, 3000);
}

function manualStart() {
	vPlayer.play();
}

function videoClicked() {
  vPlayer.play();
}
</script>
</head>
<body style='margin: 0; padding: 0;'>

<script>
vPlayer=document.createElement('video');
vPlayer.src="<?php echo 'data/'.$user.'/done/'.$uid.'/video.mp4'; ?>";
vPlayer.style.display='none';
vPlayer.addEventListener('click', videoClicked, false);
vPlayer.addEventListener('play', startProcessing, false);
vPlayer.addEventListener('ended', stopProcessing, false);
vPlayer.addEventListener('loadedmetadata', startPlaying, false);
//document.body.appendChild(vPlayer);

bufferCanvas=document.createElement('canvas');
buffer=bufferCanvas.getContext('2d');
bufferCanvas.setAttribute("width", w);
bufferCanvas.setAttribute("height", 2*h);
//document.body.appendChild(bufferCanvas);

outputCanvas=document.createElement('canvas');
output=outputCanvas.getContext('2d');
document.body.appendChild(outputCanvas);

vPlayer.load();

</script>

</body>
</html>

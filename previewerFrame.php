<?php
	$videoPath=$_GET['videoPath'];
	$w=$_GET['w'];
	$h=$_GET['h'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>CasterBuddy</title>
<script>
var timer;
var outputCanvas;
var output;
var bufferCanvas;
var buffer;
var vPlayer;
var w=<?php echo $w; ?>;
var h=<?php echo $h; ?>;

var frstfrm=true;
var dy=0;
function _processFrame() {
	buffer.drawImage(vPlayer, 0, 0);
	
	//var	image=buffer.getImageData(0, 0, w, h-dy-7);
	//var alpha=buffer.getImageData(0, h-dy, w, h-dy-7);
	var	image=buffer.getImageData(0, 0, w, h-dy-0);
	var alpha=buffer.getImageData(0, h-dy, w, h-dy-0);
	var	imageData=image.data;
	var	alphaData=alpha.data;
	
	if(frstfrm) {
		if(navigator.userAgent.toLowerCase().indexOf('firefox')<0) {
			if(alphaData[w*4]<50) dy=Math.round(6-(400-w)/50)+1;
		}
      frstfrm=false;
	} else {
		var strt=w*0+3;
		var len=imageData.length;
		for(var i=strt; i<len; i+=4) imageData[i]=alphaData[i-1];
	
//		output.putImageData(image, 0, 0, 0, 0, w, h-6);
		output.putImageData(image, 0, 0, 0, dy, w, h-dy);
    }
}

function startProcessing() {
	timer = setInterval(_processFrame, 100);
}

function stopProcessing() {
	clearInterval(timer);
	parent.postMessage("close", "*");
}

function startPlaying() {
	outputCanvas.setAttribute("width", w);
	outputCanvas.setAttribute("height", h);
  
	setTimeout(function(){ vPlayer.play(); }, 3000);
}

function manualStart() {
	vPlayer.play();
}
</script>
</head>
<body style='margin: 0; padding: 0;'>

<script>
vPlayer=document.createElement('video');
vPlayer.src="<?php echo $videoPath; ?>";
vPlayer.style.display='none';
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

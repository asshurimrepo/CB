

    <video preload="auto" id="video" width="400" height="450">
         <source src="/video/OhE1P7udxRZaHftw2.mp4" type="video/mp4">
    </video>

	<button onclick="playVideo();">Play</button>
	<button onclick="startProcessing();">Process</button>


    <canvas  width="400" height="450" id="buffer"></canvas>
	<canvas width="400" height="450" id="output"></canvas>


<script type="text/javascript">
	// OhE1P7udxRZaHftw2
	// MjsoyK9dxFTHREE
	var vPlayer = document.getElementById("video");
	var buffer = document.getElementById("buffer").getContext('2d');
	var output = document.getElementById("output").getContext('2d');
	var w = 400;
	var h = 450/2;
	var dy = 0;
 	var frstfrm = true;

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

	function playVideo() {
		vPlayer.play();
	}


</script>
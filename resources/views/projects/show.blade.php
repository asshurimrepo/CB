

    <video preload="auto" id="video" width="400" height="450">
         <source src="/video/FDntFDhAIWdogTraining.mp4" type="video/mp4">
    </video>

	<button onclick="playVideo();">Play</button>
	<button onclick="startProcessing();">Old Script</button>
	<button onclick="startProcessing2();">New Script</button>
	<button onclick="stopProcessing();">Stop</button>


    <canvas  width="400" height="450" id="buffer"></canvas>
	<canvas width="400" height="450" id="output" style="border: 1px solid #000;"></canvas>
	<canvas width="400" height="450" id="output2" style="border: 1px solid #000;"></canvas>


<script type="text/javascript">
	// OhE1P7udxRZaHftw2
	// MjsoyK9dxFTHREE
	var vPlayer = document.getElementById("video");
	var buffer = document.getElementById("buffer").getContext('2d');
	var output = document.getElementById("output").getContext('2d');
	var output2 = document.getElementById("output2").getContext('2d');
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
				console.log(dy);
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

	function _processFrame2() {
		buffer.drawImage(vPlayer, 0, 0);

		var	image=buffer.getImageData(0, 0, w, h);


		// Step 3: Go pixel by pixel and detect whether or not we're at the green screen.
		for ( var i=0; i<image.data.length; i+=4 ) {
			var makeTrans = false;

			// if green is super high, filter it out, since it's green screen.
			if ( image.data[i+1] > 230 ) {
				makeTrans = true;
			}
			// if green is high but not super high, check other colors.
			else if ( image.data[i+1] > 100 ) {
				// if the ratio of the average of green to the other colors is > 1.7, it's green screen.
				if ( image.data[i+1]/((image.data[i]+image.data[i+2])/2) > 1.7 ) {
					makeTrans = true;
				}
				// left side filter, since there is color blending at the edges of Ty.
				if ( image.data[i+1] > 130 && image.data[i-1]==0 ) {
					// makeTrans = true;
				}
				// // right side filter, for the same reason.
				if ( image.data[i+1] > 130 && (image.data[i+5]/((image.data[i+4]+image.data[i+6])/2) > 1.6 || image.data[i+5] > 230) ) {
					// makeTrans = true;
				}
			}
			// Otherwise, reduce the overall green of that pixel. The green bounced back onto his face
			// during filming, the colors blended, etc. Basically reduce the green effect.
			else {
				// image.data[i+1] *= 0.7;
			}

			// Make transparent the green screen pixel.
			if ( makeTrans ) { image.data[i+3] = 0; }
		}

		// console.log(imageData);
		output2.putImageData(image, 0, 0);

	}

	function startProcessing() {
		timer = setInterval(_processFrame, 100);
	}

	function startProcessing2() {
		timer = setInterval(_processFrame2, 10);
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
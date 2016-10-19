<html>
<head>
	<meta charset="UTF-8">
	<title>Embed</title>
	
	<link rel="stylesheet" href="/css/bootstrap-reset.css">
	<link rel="stylesheet" href="/css/bootstrap.css">

	<!-- Video.js file -->
	<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />

	<!-- If you'd like to support IE8 -->
	<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

	<style>
		.controls {
			position: fixed;
			bottom: 10px;
			left: 0;
			width: 100%;
			text-align: center;
			/*transition: all 1s;*/
			display: none;
		}

		.controls button {
			font-size: 20px; 
			display: inline-block;
			/*padding: 5px;*/
			border-radius: 5px;
			color: #000;
			/*background: #fafafa;*/
		}

		.loader-3 {
			position: fixed;
			z-index: 9999;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
	</style>
</head>
<body style="background: transparent !important; min-height: 100px;">

	<div class="controls">
		<button class="btn hide"><i class="fa fa-play"></i></button>
		<button class="btn"><i class="fa fa-pause"></i></button>

		<button class="btn hide"><i class="fa fa-volume-off"></i></button>
		<button class="btn"><i class="fa fa-volume-up"></i></button>
	</div>

	<div class="loader-3">
	      <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
	      <span class="sr-only">Loading...</span>
  	</div>	

	<video id="embed-casters" style="width: 100%; display: none;">
		<source type="video/mp4" src="{{ $source }}">
	</video>

	<canvas id="output" style="width: 100%;"></canvas>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- seriously.js -->
    <script src="/js/seriously.js" type="text/javascript"></script>
    <script src="/js/seriously.chroma.js" type="text/javascript"></script>

    <!--video.js-->
	<script src="http://vjs.zencdn.net/5.10.8/video.js"></script>

	<script>
		var project = {!! json_encode($project) !!}
		var video = videojs('embed-casters', { "controls": "false", "preload": "auto" });
		
		$(document).ready(function(){

			$("body").on('click', 'canvas#output', function () {
				parent.postMessage({
					id: "casterbuddy",
					action: "clicked"
				}, "*");
			}).on('mouseenter', function () {
				$(".controls").fadeIn('fast');
			}).on('mouseleave', function () {
				$(".controls").fadeOut('fast');
			});

			video.on("loadedmetadata", function () {
				$(".loader-3").hide();
				var vPlayer = document.getElementById("embed-casters_html5_api");

				$("canvas#output").get(0).setAttribute("width", vPlayer.videoWidth);
				$("canvas#output").get(0).setAttribute("height", vPlayer.videoHeight);

				var seriously,
		            chroma,
		            target;

		          seriously = new Seriously();

		          target = seriously.target('#output');
		          chroma = seriously.effect('chroma');

		          chroma.source = "#embed-casters_html5_api";
		          target.source = chroma;

		          chroma['balance'] = project.options.video_settings.balance;
		          chroma['clipWhite'] = project.options.video_settings.clip_white;
		          chroma['clipBlack'] = project.options.video_settings.clip_black;
		          chroma['weight'] = project.options.video_settings.weight;
		          seriously.go();

		          video.play();
			});
		});

		video.on("timeupdate", function () {
				parent.postMessage({
					id: 'casterbuddy',
					currentTime: video.currentTime(),
					width: $("canvas").width(),
					height: $("canvas").height(),
					duration: video.duration(),
					ended: false
				}, "*");
		 });

		video.on("ended", function () {
			parent.postMessage({
					id: 'casterbuddy',
					ended: true
			}, "*");
		});
	</script>
</body>
</html>
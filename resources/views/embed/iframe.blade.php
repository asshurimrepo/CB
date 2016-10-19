<html>
<head>
	<meta charset="UTF-8">
	<title>Embed</title>
	
	<link rel="stylesheet" href="/css/bootstrap-reset.css">
	<link rel="stylesheet" href="/css/bootstrap.css">

	<!-- Video.js file -->
	<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">

	<!-- If you'd like to support IE8 -->
	<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>


</head>
<body style="background: transparent !important;">

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

			video.on("loadedmetadata", function () {
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
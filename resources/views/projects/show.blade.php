<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Accept-Language, Content-Language, Authorization, X-Request-With, X-Access-Token, X-Application-Name, X-Request-Sent-Time');
 ?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Embed Tests</title>
</head>
<body>
<link rel="stylesheet" href="http://casterbuddy.com/css/project-player.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
<script src="http://casterbuddy.com/js/seriously.js" type="text/javascript"></script>
<script src="http://casterbuddy.com/js/seriously.chroma.js" type="text/javascript"></script>
<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script>
        var casterScript = document.createElement('script');
        casterScript.setAttribute("src", "http://casterbuddy.com/embed/caster.js?ID=270");
        document.querySelector('body').appendChild(casterScript);
</script>
<div id="caster-embed-270"><project-player :project="active_project"></project-player></div>
</body>
</html>
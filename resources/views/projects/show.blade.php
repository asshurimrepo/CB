<html>
<head>
  <meta charset="UTF-8">
  <title>Embed Tests</title>
</head>
<body><link rel="stylesheet" href="http://caster-buddy.dev/css/project-player.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
<script src="http://caster-buddy.dev/js/seriously.js" type="text/javascript"></script>
<script src="http://caster-buddy.dev/js/seriously.chroma.js" type="text/javascript"></script>
<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script>
        var casterScript = document.createElement('script');
        casterScript.setAttribute("src", "http://caster-buddy.dev/embed/caster.js?ID=10");
        document.querySelector('body').appendChild(casterScript);
</script>
<div id="caster-embed-10"><project-player :project="active_project"></project-player></div></body>
</html>
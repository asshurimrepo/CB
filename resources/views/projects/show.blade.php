<html>
<head>
	<meta charset="UTF-8">
	<title>Caster Buddy Test Embed</title>
</head>
<body>
	
	<iframe style="position: absolute; right: 0; bottom: 0;" src="http://casterbuddy.dev/embed/iframe/14" frameborder="0" width="300px" scrolling="no"></iframe>
    
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script>
		var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		var eventer = window[eventMethod];
		var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

		// Listen to message from child window
		eventer(messageEvent,function(e) {
		    var key = e.message ? "message" : "data";
		    var data = e[key];

		    $("iframe").height(data.height);


		    console.log(data);
		},false);
	</script>

</body>
</html>
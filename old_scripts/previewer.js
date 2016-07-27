var xhr;

var container;
var ovl;
var btnClose;
var btnPlay;
var posx=0;	// upper left
var posy=0;

var videoPath="";
var playerWidth=0;
var playerHeight=0;
var doubleHeight=0;

function loadVideoResponse() {
    if (xhr.readyState==4) {
        var data=xhr.responseText;
        //alert(data);
        if(data=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(data.length>0) {
			var lines=data.split("\n");
			for(i=0; i<lines.length; i++) {
				var line=lines[i].split("=");
				
				if(line[0]=="displayAfter") displayAfter=parseInt(line[1]);
				else if(line[0]=="videoPath") videoPath=line[1];
				else if(line[0]=="playerWidth") playerWidth=parseInt(line[1]);
				else if(line[0]=="playerHeight") playerHeight=parseInt(line[1]);
			}
			doubleHeight=playerHeight*2;
			initPlayer();
			
			container.style.display='block';
			_playVideo();
		}
	}
}

function createCORSRequest(method, url) {
	var xhr = new XMLHttpRequest();
	if ("withCredentials" in xhr) xhr.open(method, url, true);	// Chrome/Firefox/Opera/Safari.
	else if (typeof XDomainRequest != "undefined") {
		xhr = new XDomainRequest();								// IE.
		xhr.open(method, url);
	} else xhr = null;											// XMLHttpRequest not supported.
	
	return xhr;
}

var view=0;
function viewVideo(vid, w) {
	var fd = new FormData();
	fd.append("vid", vid);
	fd.append("width", w);
	
	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", loadVideoResponse, false);

	xhr.open("POST", "previewVideo.php", true);
	xhr.send(fd);
}

function _playVideo() {
	container.src="previewerFrame.php?videoPath="+videoPath+"&w="+playerWidth+"&h="+playerHeight;
	container.style.display='block';
	ovl.style.display='block';
}

function _stopVideo() {
	container.src="";
	container.style.display='none';
	ovl.style.display='none';
}

function _closeclicked() {
	_stopVideo();
}

function _videoended() {
	_stopVideo();
}

var debug;
function initPlayer() {
	if(!document.body.contains(container)) container=document.createElement('iframe');
	container.id='playerFrame';
	container.style.position='fixed';
	container.style.overflow="hidden";
	container.style.width=(playerWidth+25)+"px";
	container.style.height=(playerHeight+25)+"px";
	//container.style.border='1px solid rgba(255, 0, 0, 1)';
	container.style.border='none';
	posx=(window.innerWidth-playerWidth)/2;	// centered
	posy=(window.innerHeight-playerHeight)/2;
	container.style.left=posx+"px";
	container.style.top=posy+"px";
	container.style.display='none';
	
	if(!document.body.contains(ovl)) ovl=document.createElement('div');
	ovl.style.position='fixed';
	ovl.style.width=(playerWidth+5)+"px";
	ovl.style.height=(playerHeight+5)+"px";
	ovl.style.border='none';
	ovl.style.overflowX='hidden';
	ovl.style.overflowY='hidden';
	ovl.style.left=posx+"px";
	ovl.style.top=posy+"px";
	ovl.style.display='none';
	
	if(!document.contains(btnClose)) btnClose=document.createElement('div');
	btnClose.style.width=12+"px";
	btnClose.style.height=12+"px";
	btnClose.style.padding=0+"px";
	btnClose.style.border='1px solid #888888';
	btnClose.style.color='red';
	btnClose.style.backgroundColor='#bbbbbb';
	btnClose.style.opacity="0.7";
	btnClose.style.cursor='pointer';
	btnClose.style.position='absolute';
	btnClose.style.display='block';
	btnClose.style.textAlign='center';
	btnClose.style.font="10px sans-serif";
	btnClose.innerHTML="X";
	btnClose.onclick=_closeclicked;
	btnClose.style.top=5+"px";
	btnClose.style.left="auto";
	btnClose.style.right=5+"px";
	
	if(!document.contains(btnPlay)) btnPlay=document.createElement('div');
	btnPlay.style.width=12+"px";
	btnPlay.style.height=12+"px";
	btnPlay.style.padding=0+"px";
	btnPlay.style.border='1px solid #888888';
	btnPlay.style.color='red';
	btnPlay.style.backgroundColor='#bbbbbb';
	btnPlay.style.opacity="0.7";
	btnPlay.style.cursor='pointer';
	btnPlay.style.position='absolute';
	btnPlay.style.display='block';
	btnPlay.style.textAlign='center';
	btnPlay.style.font="10px sans-serif";
	btnPlay.innerHTML="&#9658;";
	btnPlay.onclick=_playVideo;
	btnPlay.style.top=20+"px";
	btnPlay.style.left="auto";
	btnPlay.style.right=5+"px";
	
	ovl.appendChild(btnPlay);
	ovl.appendChild(btnClose);
	
	btnPlay.style.zIndex=9998;
	btnClose.style.zIndex=9999;
	
	document.body.appendChild(container);
	document.body.appendChild(ovl);
}

window.addEventListener("message", function (e) {
	if(e.data=="close") _closeclicked();
}, false);

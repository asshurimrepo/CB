var user="";
var vid="";
var validityCode="";

var displayAfter=0;
var dimmedBG=false;
var displayAutomatically=true;
var cookieLife=0;
var stopShowingWhenCTA=false;
var stopShowingWhenStop=false;

var outputCanvas;
var output;
var bufferCanvas;
var buffer;
var dimmed;
var container;
var ovl;
var vPlayer;
var txtOvl;
var phnOvl;
var btnOvl;
var frmOvl;
var btnClose;
var btnPlay;
var posx=0;	// upper left
var posy=0;

var videoPath="";
var videoPoster="";
var playerWidth=0;
var playerHeight=0;
var playerPos=1;
var playerOffsX=0;
var playerOffsY=0;
var playerGlassBG=false;
var playerExitOnEnd=false;
var playerWithClose=false;

var playerURL="";

var iframeURL="";
var extVideoURL="";
var extVideoDuration=0;

var playerTxtLine1="";
var playerTxtLine2="";
var playerTxtPos=0;
var playerTxtStart=-1;
var playerTxtEnd=-1;
var playerTxtStyle="";

var playerPhoneNr="";
var playerPhoneHTML="";
var playerPhnPos=0;
var playerPhnStart=-1;
var playerPhnEnd=-1;
var playerPhnStyle="";

var playerBtnLabel="";
var playerBtnCode="";
var playerBtnPos=0;
var playerBtnStart=-1;
var playerBtnEnd=-1;
var playerBtnStyle="";

var playerFrmCode="";
var playerFrmStart=-1;
var playerFrmEnd=-1;

//var servicePath="http://192.168.1.70/CasterBuddy3/";
var servicePath="http://www.casterbuddy.com/";

function isMobile() {
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) return true;
	return false;
}

function isMobileChrome() {
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) &&
	/Safari/i.test(navigator.userAgent)) return true;
	return false;
}

function loadVideoResponse() {
    if (xhr.readyState==4) {
        var data=xhr.responseText;
        //alert(data);
        if(data.length>0) {
			var lines=data.split("\n");
			for(i=0; i<lines.length; i++) {
				var line=lines[i].split("=");
				
				if(line[0]=="user") user=line[1];
				else if(line[0]=="validityCode") validityCode=line[1];
				else if(line[0]=="displayAfter") displayAfter=parseInt(line[1]);
				else if(line[0]=="dimmedBG") dimmedBG=line[1]=='1' ? true : false;
				else if(line[0]=="displayAutomatically") displayAutomatically=line[1]=='1' ? true : false;
				else if(line[0]=="cookieLife") cookieLife=parseInt(line[1]);
				else if(line[0]=="stopShowingWhen") {
					var tmp=parseInt(line[1]);
					if(tmp%2>0) stopShowingWhenCTA=true;
					if(tmp>1) stopShowingWhenStop=true;
				}
				
				else if(line[0]=="iframeURL") iframeURL=atob(line[1]);
				else if(line[0]=="extVideoURL") extVideoURL=atob(line[1]);
				else if(line[0]=="extVideoDuration") extVideoDuration=parseInt(line[1])+4;
				
				else if(line[0]=="videoPath") videoPath=line[1];
				else if(line[0]=="playerWidth") playerWidth=parseInt(line[1]);
				else if(line[0]=="playerHeight") playerHeight=parseInt(line[1]);
				else if(line[0]=="playerPos") playerPos=parseInt(line[1]);
				else if(line[0]=="playerOffsX") playerOffsX=parseInt(line[1]);
				else if(line[0]=="playerOffsY") playerOffsY=parseInt(line[1]);
				else if(line[0]=="playerGlassBG") playerGlassBG=line[1]=='1' ? true : false;
				else if(line[0]=="playerExitOnEnd") playerExitOnEnd=line[1]=='1' ? true : false;
				
				else if(line[0]=="playerURL") playerURL=line[1];
				
				else if(line[0]=="playerTxtLine1") playerTxtLine1=line[1];
				else if(line[0]=="playerTxtLine2") playerTxtLine2=line[1];
				else if(line[0]=="playerTxtStyle") playerTxtStyle=line[1];
				else if(line[0]=="playerTxtPos") playerTxtPos=parseInt(line[1]);
				else if(line[0]=="playerTxtStart") playerTxtStart=parseInt(line[1]);
				else if(line[0]=="playerTxtEnd") playerTxtEnd=parseInt(line[1]);
				
				else if(line[0]=="playerPhoneNr") playerPhoneNr=line[1];
				else if(line[0]=="playerPhnStyle") playerPhnStyle=line[1];
				else if(line[0]=="playerPhnPos") playerPhnPos=parseInt(line[1]);
				else if(line[0]=="playerPhnStart") playerPhnStart=parseInt(line[1]);
				else if(line[0]=="playerPhnEnd") playerPhnEnd=parseInt(line[1]);
				playerPhoneHTML=playerPhoneNr;
				if(isMobile()) playerPhoneHTML="<a href='tel:"+playerPhoneNr+"'>"+playerPhoneHTML+"</a>";
				
				else if(line[0]=="playerBtnLabel") playerBtnLabel=line[1];
				else if(line[0]=="playerBtnCode") { tmp=line[1]; playerBtnCode=atob(tmp); }
				else if(line[0]=="playerBtnStyle") playerBtnStyle=line[1];
				else if(line[0]=="playerBtnPos") playerBtnPos=parseInt(line[1]);
				else if(line[0]=="playerBtnStart") playerBtnStart=parseInt(line[1]);
				else if(line[0]=="playerBtnEnd") playerBtnEnd=parseInt(line[1]);
				
				else if(line[0]=="playerFrmCode") { tmp=line[1]; playerFrmCode=atob(tmp); }
				else if(line[0]=="playerFrmStart") playerFrmStart=parseInt(line[1]);
				else if(line[0]=="playerFrmEnd") playerFrmEnd=parseInt(line[1]);
			}
			playerTxtStyle=playerTxtStyle.replace("_", " ");
			playerPhnStyle=playerPhnStyle.replace("_", " ");
			playerBtnStyle=playerBtnStyle.replace("_", " ");
			
			initPlayer();
			//videoPoster=servicePath+videoPath;
			//videoPoster=videoPoster.substring(0, videoPoster.length-4)+".png";
			
			if(!isMobileChrome()) {
				if(displayAfter>0) timer = setInterval(_wait2play, 100);
				else _playVideo();
			} else {
				container.contentDocument.write("<img id='poster' src='data/"+user+"/done/"+vid+".png' width="+playerWidth+" height="+playerHeight+" onClick=\"parent.postMessage('replay', '*');\">");
				container.style.display='block';
			}
		}
	}
}

var secCount=0;
function _wait2play() {
	secCount+=0.1;
	if(displayAfter>secCount) return;
	
	clearInterval(timer);
	_playVideo();
	//if(!displayAutomatically) vPlayer.pause();
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
function loadVideo(id) {
	vid=id;
	//alert(vid);
	
	// If cookie set, leave
	var re=new RegExp(vid, "g");
	if(re.test(document.cookie)) return;
	
	var fd = new FormData();
	fd.append("uid", vid);
	count=(typeof forPreview=='undefined' ? 1 : 0);
	fd.append("view", view);
	
	xhr = new XMLHttpRequest();
	
	xhr.addEventListener("load", loadVideoResponse, false);
	
	xhr.open("POST", servicePath+"loadVideo.php", true);
	xhr.send(fd);
}

var timer;
var sec=0;
function _playVideo() {
	clearInterval(timer);
	sec=0;
	
	container.style.width=(playerWidth+25)+"px";
	container.style.height=(playerHeight+25)+"px";
	ovl.style.width=(playerWidth+5)+"px";
	ovl.style.height=(playerHeight+5)+"px";
	
	container.src=servicePath+"playerFrame.php?uid="+vid+"&closeOnEnd="+(playerExitOnEnd ? 1 : 0)+"&validityCode="+validityCode;
	container.style.display='block';
	ovl.style.display='block';
	//container.contentWindow.location.reload(true);
	
	sec=0;
}

function _stopVideo() {
	_closeclicked()
	
	if(typeof forPreview !== 'undefined') location.href="";
}

function _closeclicked() {
	clearInterval(timer);
	sec=0;
	
	dimmed.remove();
	ovl.style.display='none';
	
	// Disable player for the next "cookieLife" days
	if(stopShowingWhenStop) {
		var exp = new Date();
		exp.setDate(exp.getDate() + cookieLife);
		document.cookie = 'vid='+vid+'; expires=' + exp.toGMTString();
	}
}

function _casterFinished() {
	if(extVideoURL=="") { _closeclicked(); return; }
	
	var n1=extVideoURL.indexOf("width=")+7;
	var n2=extVideoURL.indexOf("\"", n1+1);
	var w=parseInt(extVideoURL.substring(n1, n2));
	
	n1=extVideoURL.indexOf("height=")+8;
	n2=extVideoURL.indexOf("\"", n1+1);
	var h=parseInt(extVideoURL.substring(n1, n2));
	
	var n1=extVideoURL.indexOf("src=")+5;
	var n2=extVideoURL.indexOf("\"", n1+1);
	var s=extVideoURL.substring(n1, n2);
	
	container.style.width=w+"px";
	container.style.height=h+"px";
	container.src=s+"?autoplay=1";
	
	ovl.style.width=w+"px";
	ovl.style.height=h+"px";
	
	timer = setInterval(_closeclicked, extVideoDuration*1000);
}

function _videoclicked() {
	_stopVideo();
	
	// Disable player for the next "cookieLife" days
	if(stopShowingWhenCTA) {
		var exp = new Date();
		exp.setDate(exp.getDate() + cookieLife);
		document.cookie = 'vid='+vid+'; expires=' + exp.toGMTString();
	}
	
	location.href=playerURL;
}

function _btnclicked() {
	if(casterbuddy_btnclicked) {
		_stopVideo();
		casterbuddy_btnclicked();
	}
}

function _frmclicked() {
	if(casterbuddy_frmclicked) {
		_stopVideo();
		var txt=document.getElementById('casterbuddy_form').value;
		casterbuddy_frmclicked(txt);
	}
}

function _playing() {
	sec++;
	
	if(sec==playerTxtStart) txtOvl.style.display='block';
	if(sec==playerTxtEnd) txtOvl.style.display='none';
	if(sec==playerPhnStart) phnOvl.style.display='block';
	if(sec==playerPhnEnd) phnOvl.style.display='none';
	if(sec==playerBtnStart) btnOvl.style.display='block';
	if(sec==playerBtnEnd) btnOvl.style.display='none';
	if(sec==playerFrmStart) frmOvl.style.display='block';
	if(sec==playerFrmEnd) frmOvl.style.display='none';
}

var debug;
function initPlayer() {
	dimmed=document.createElement('div');
	dimmed.style.position='fixed';
	dimmed.style.left="0px";
	dimmed.style.top="0px";
	dimmed.style.width="100%";
	dimmed.style.height="100%";
	dimmed.style.draggable=false;
	if(iframeURL.length>0) {
		var ifr=document.createElement('iframe');
		dimmed.style.backgroundColor="white";
		ifr.src=iframeURL;
		ifr.style.position="fixed";
		ifr.style.left="0px";
		ifr.style.top="0px";
		ifr.style.width="100%";
		ifr.style.height="100%";
		dimmed.appendChild(ifr);
	} else {
		if(dimmedBG) dimmed.style.backgroundColor="rgba(0, 0, 0, 0.2)";
		else dimmed.style.backgroundColor="rgba(0, 0, 0, 0)";
	}
	
	if(!document.body.contains(container)) container=document.createElement('iframe');
	container.id='playerFrame';
	container.style.position='fixed';
	container.style.overflow="hidden";
	container.style.width=(playerWidth+25)+"px";
	container.style.height=(playerHeight+25)+"px";
	if(playerGlassBG) {
		//container.style.boxShadow="0px 0px 10px 0px rgba(0,0,0,0.3)";
		container.style.boxShadow="5px 5px 5px 0px rgba(0,0,0,0.3)";
		container.style.backgroundColor="rgba(0, 160, 80, 0.15)";
		container.style.border='1px solid rgba(0, 40, 40, 0.2)';
	}
	//container.style.border='1px solid rgba(255, 0, 0, 1)';
	container.style.border='none';
	if(playerPos==0) { posx=(window.innerWidth-playerWidth)/2; posy=(window.innerHeight-playerHeight)/2; } // centered
	if(playerPos==2) { posx=window.innerWidth-playerWidth-20; posy=0; } // upper right
	if(playerPos==3) { posx=0; posy=window.innerHeight-playerHeight-20; } // bottom left
	if(playerPos==4) { posx=window.innerWidth-playerWidth-20; posy=window.innerHeight-playerHeight-20; } // bottom right
	container.style.left=(posx+playerOffsX)+"px";
	container.style.top=(posy+playerOffsY)+"px";
	container.style.display='none';
	
	if(!document.body.contains(ovl)) ovl=document.createElement('div');
	ovl.style.position='fixed';
	ovl.style.width=(playerWidth+5)+"px";
	ovl.style.height=(playerHeight+5)+"px";
	ovl.style.border='none';
	ovl.style.overflowX='hidden';
	ovl.style.overflowY='hidden';
	ovl.style.left=(posx+playerOffsX)+"px";
	ovl.style.top=(posy+playerOffsY)+"px";
	ovl.style.display='none';
	
	if(!document.body.contains(txtOvl)) txtOvl=document.createElement('div');
	txtOvl.style.width=playerWidth+"px";
	txtOvl.style.position='absolute';
	txtOvl.style.display='none';
	txtOvl.innerHTML="<p style=\""+playerTxtStyle+"\">"+playerTxtLine1+"<br/>"+playerTxtLine2+"</p>";
	if(playerTxtPos==0) txtOvl.style.bottom=10+"px";
	else if(playerTxtPos==1) txtOvl.style.top=(playerHeight-txtOvl.clientHeight)/2+"px";
	else if(playerTxtPos==2) txtOvl.style.top=10+"px";
	
	if(!document.body.contains(phnOvl)) phnOvl=document.createElement('div');
	phnOvl.style.width=playerWidth+"px";
	phnOvl.style.position='absolute';
	phnOvl.style.display='none';
	phnOvl.innerHTML="<p style=\""+playerPhnStyle+"\">"+playerPhoneHTML+"</p>";
	if(playerPhnPos==0) phnOvl.style.bottom=10+"px";
	else if(playerPhnPos==1) phnOvl.style.top=(playerHeight-phnOvl.clientHeight)/2+"px";
	else if(playerPhnPos==2) phnOvl.style.top=10+"px";
	
	if(!document.body.contains(btnOvl)) btnOvl=document.createElement('div');
	btnOvl.style.width=playerWidth+"px";
	btnOvl.style.position='absolute';
	btnOvl.style.display='none';
	//alert(playerBtnCode);
	btnOvl.innerHTML=playerBtnCode;
	//btnOvl.innerHTML="<p style=\""+playerBtnStyle+"\">"+playerBtnLabel+"</p>";
	if(playerBtnPos==0) btnOvl.style.bottom=10+"px";
	else if(playerBtnPos==1) btnOvl.style.top=(playerHeight-btnOvl.clientHeight)/2+"px";
	else if(playerBtnPos==2) btnOvl.style.top=10+"px";
	
	if(!document.body.contains(frmOvl)) frmOvl=document.createElement('div');
	frmOvl.style.width=playerWidth+"px";
	frmOvl.style.position='absolute';
	frmOvl.style.display='none';
	frmOvl.innerHTML=playerFrmCode;
	frmOvl.style.top=0+"px";
	
	if(!document.body.contains(btnClose)) btnClose=document.createElement('div');
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
	if(playerPos==1 || playerPos==3) { btnClose.style.right="auto"; btnClose.style.left=5+"px"; }
	else { btnClose.style.left="auto"; btnClose.style.right=5+"px"; }
	
	if(!document.body.contains(btnPlay)) btnPlay=document.createElement('div');
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
	if(playerPos==1 || playerPos==3) { btnPlay.style.right="auto"; btnPlay.style.left=5+"px"; }
	else { btnPlay.style.left="auto"; btnPlay.style.right=5+"px"; }
	
	ovl.appendChild(txtOvl);
	ovl.appendChild(phnOvl);
	ovl.appendChild(btnOvl);
	ovl.appendChild(frmOvl);
	ovl.appendChild(btnPlay);
	ovl.appendChild(btnClose);
	
	txtOvl.style.zIndex=9994;
	phnOvl.style.zIndex=9995;
	btnOvl.style.zIndex=9996;
	frmOvl.style.zIndex=9997;
	btnPlay.style.zIndex=9998;
	btnClose.style.zIndex=9999;
	
	dimmed.appendChild(container);
	dimmed.appendChild(ovl);
	document.body.appendChild(dimmed);
	//document.body.appendChild(container);
	//document.body.appendChild(ovl);
	
	//debug=document.createElement('div');
	//document.body.appendChild(debug);
}

window.addEventListener("message", function (e) {
	if(e.data=="playing") _playing();
	else if(e.data=="replay") _playVideo();
	else if(e.data=="finished") _casterFinished();
}, false);

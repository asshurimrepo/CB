<!-- The Properties -->
<script>
var vid=0;
function loadPropertiesResponse() {
    if (xhr.readyState==4) {
        var data=xhr.responseText;
        if(data=="Login") location.replace('<?php echo $_ROOT_; ?>');
        var tmp=0;
        if(data.length>0) {
			var lines=data.split("\n");
			for(i=0; i<lines.length; i++) {
				var line=lines[i].split("=");
				
				if(line[0]=="propertyTitle") document.getElementById("propertyTitle").value=line[1];
				else if(line[0]=="propertyPlan") document.getElementById("propertyPlan").innerHTML=line[1];
				else if(line[0]=="propertyActive") document.getElementById("propertyActive").checked=(line[1]==1 ? true : false);
				else if(line[0]=="propertyPosition") document.getElementById("propertyPosition").value=line[1];
				else if(line[0]=="propertyOffsetX") document.getElementById("propertyOffsetX").value=line[1];
				else if(line[0]=="propertyOffsetY") document.getElementById("propertyOffsetY").value=line[1];
				else if(line[0]=="propertyDisplayAutomatically") document.getElementById("propertyDisplayAutomatically").checked=(line[1]==1 ? true : false);
				else if(line[0]=="propertyDisplayAfter") document.getElementById("propertyDisplayAfter").value=line[1];
				
				else if(line[0]=="propertyDimmedBG") document.getElementById("propertyDimmedBG").checked=(line[1]==1 ? true : false);
				else if(line[0]=="propertyGlass") document.getElementById("propertyGlass").checked=(line[1]==1 ? true : false);
				else if(line[0]=="propertyExitOnEnd") document.getElementById("propertyExitOnEnd").checked=(line[1]==1 ? true : false);
				
				else if(line[0]=="propertyCookieLife") document.getElementById("propertyCookieLife").value=line[1];
				
				else if(line[0]=="propertyStopShowingWhen") {
					tmp=parseInt(line[1]);
					if(tmp%2>0) document.getElementById("propertyWhenCTA").checked=true;
					if(tmp>1) document.getElementById("propertyWhenStop").checked=true;
				}
				
				else if(line[0]=="propertyIframeURL") document.getElementById("iframeURL").value=atob(line[1]);
				else if(line[0]=="propertyExtVideoURL") document.getElementById("extVideoURL").value=atob(line[1]);
				else if(line[0]=="propertyExtVideoDuration") document.getElementById("extVideoDuration").value=line[1];
			}
		}
    }
}

function loadProperties(id) {
	vid=id;

	document.getElementById("propertyTitle").value="";
	document.getElementById("propertyPlan").innerHTML="";
	document.getElementById("propertyActive").checked=false;
	document.getElementById("propertyPosition").value=0;
	document.getElementById("propertyOffsetX").value="0";
	document.getElementById("propertyOffsetY").value="-1";
	document.getElementById("propertyDisplayAutomatically").checked=false;
	document.getElementById("propertyDisplayAfter").value="0";
	
	document.getElementById("propertyDimmedBG").checked=false;
	document.getElementById("propertyGlass").checked=false;
	document.getElementById("propertyExitOnEnd").checked=false;
	
	document.getElementById("propertyCookieLife").value="0";
	
	document.getElementById("propertyWhenCTA").checked=false;
	document.getElementById("propertyWhenStop").checked=false;
	
	document.getElementById("iframeURL").value="";
	document.getElementById("extVideoURL").value="";
	document.getElementById("extVideoDuration").value="0";

	document.getElementById("save_error1").innerHTML="";
	
	var fd = new FormData();
	fd.append("vid", vid);

	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", loadPropertiesResponse, false);

	xhr.open("POST", "loadProperties.php");
	xhr.send(fd);
}

function savePropertiesResponse() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(r=="OK") closeProperties();
        else document.getElementById("save_error1").innerHTML=r;
	}
}

function saveProperties() {
	var data="propertyTitle="+document.getElementById("propertyTitle").value+"\n";
	data+="propertyActive="+(document.getElementById("propertyActive").checked ? 1 : 0)+"\n";
	data+="propertyPosition="+document.getElementById("propertyPosition").value+"\n";
	data+="propertyOffsetX="+document.getElementById("propertyOffsetX").value+"\n";
	data+="propertyOffsetY="+document.getElementById("propertyOffsetY").value+"\n";
	data+="propertyDisplayAutomatically="+(document.getElementById("propertyDisplayAutomatically").checked ? 1 : 0)+"\n";
	data+="propertyDisplayAfter="+document.getElementById("propertyDisplayAfter").value+"\n";
	
	data+="propertyDimmedBG="+(document.getElementById("propertyDimmedBG").checked ? 1 : 0)+"\n";
	data+="propertyGlass="+(document.getElementById("propertyGlass").checked ? 1 : 0)+"\n";
	data+="propertyExitOnEnd="+(document.getElementById("propertyExitOnEnd").checked ? 1 : 0)+"\n";
	
	data+="propertyCookieLife="+document.getElementById("propertyCookieLife").value+"\n";
	
	data+="propertyIframeURL="+btoa(document.getElementById("iframeURL").value)+"\n";
	data+="propertyExtVideoURL="+btoa(document.getElementById("extVideoURL").value)+"\n";
	data+="propertyExtVideoDuration="+document.getElementById("extVideoDuration").value+"\n";
	
	var tmp=document.getElementById("propertyWhenCTA").checked ? 1 : 0;
	tmp+=document.getElementById("propertyWhenStop").checked ? 2 : 0;
	data+="propertyStopShowingWhen="+tmp;
	//alert(data);
	
	var fd = new FormData();
	fd.append("vid", vid);
	fd.append("data", data);

	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", savePropertiesResponse, false);

	xhr.open("POST", "saveProperties.php");
	xhr.send(fd);
}

function closeProperties() {
	document.getElementById("propertiesForm").style.display="none";
	location.href="";
}
</script>
<div id='propertiesForm' class='trnsdiv'>
	<div class='divForm' style="max-width: 500px; width: 100%;">
		<div class='caption'>Options</div>
		<div class="disch">
			<h3>&ensp;Properties</h3>
			Title <input id='propertyTitle' type='text' size=40><br/>
			Active <input id='propertyActive' type='checkbox'>&ensp;
			Plan <span id='propertyPlan'>&nbsp;</span><br/>
			Position
			<select id='propertyPosition'>
				<option value=0>Centered</option>
				<option value=1>Top left</option>
				<option value=2>Top right</option>
				<option value=3>Bottom left</option>
				<option value=4>Bottom right</option>
			</select><br/>
			Offset X <input id='propertyOffsetX' type='text' size=5>&ensp;
			Offset Y <input id='propertyOffsetY' type='text' size=5><br/>
			
			Display&nbsp;automatically <input id='propertyDisplayAutomatically' type='checkbox'> after&nbsp;<input id='propertyDisplayAfter' type='text' size=2>&nbsp;sec<br/>
			
			Dimmed&nbsp;background&nbsp;<input id='propertyDimmedBG' type='checkbox'> 
			Glass&nbsp;background&nbsp;<input id='propertyGlass' type='checkbox'> 
			Exit&nbsp;on&nbsp;end&nbsp;<input id='propertyExitOnEnd' type='checkbox'><br/>
			
			Cookie&nbsp;life&nbsp;<input id='propertyCookieLife' type='text' size=2>&nbsp;days<br/>
			Stop&nbsp;showing 
			when&nbsp;CTA&nbsp;clicked&nbsp;<input id='propertyWhenCTA' type='checkbox'> 
			or&nbsp;player&nbsp;closed&nbsp;<input id='propertyWhenStop' type='checkbox'><br/>
		</div>
		<div class="disch">
			<h3>&ensp;IFrame</h3>
			URL <input id='iframeURL' type='text' size=70><br/>
		</div>
		<div class="disch">
			<h3>&ensp;External video</h3>
			<table style="padding: 3px 5px 3px 5px;"><tr>
			<td>Embed code&nbsp;</td><td><input id='extVideoURL' type='text' size=60></td>
			</tr><tr>
			<td>Duration</td><td><input id='extVideoDuration' type='text' size=5> sec</td>
			</tr></table>
		</div>
		<div id='save_error1' class='error'>&nbsp;</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<p style='clear: both;'>
				 <span class='button' onClick='saveProperties();'>&nbsp;Save</span>
				 &emsp;&emsp;
				 <span class='button' onClick='closeProperties();'>&nbsp;Cancel</span>
				 &emsp;
			</p>
		</div>
	</div><br/>
</div>

<!-- End Properties -->

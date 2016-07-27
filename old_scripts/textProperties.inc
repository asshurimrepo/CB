<!-- The Text Properties -->
<script>
function textPropertiesChanged() {
	var family="'"+document.getElementById("textFontProperty").value+"'";
	var size=document.getElementById("textSizeProperty").value+"px";
	var bold=(document.getElementById("textWeightProperty").checked ? ' bold' : '');
	var italic=(document.getElementById("textStyleProperty").checked ? ' italic' : '');
	var align=document.getElementById("textAlignProperty").value
	document.getElementById("textSizeLabel").textContent=size;
	document.getElementById("textPreview").style.font=italic+bold+' '+size+' '+family;
	document.getElementById("textPreview").style.textAlign=align;
	attributes="text-align:"+align+";font:"+italic+bold+' '+size+' '+family.replace(/ /g, '_')+";";
	
	var R=document.getElementById("fgR").value;
	var G=document.getElementById("fgG").value;
	var B=document.getElementById("fgB").value;
	document.getElementById("textPreview").style.color="rgb("+R+","+G+","+B+")";
	var c="#";
	c+=("0"+Number(R).toString(16)).slice(-2);
	c+=("0"+Number(G).toString(16)).slice(-2);
	c+=("0"+Number(B).toString(16)).slice(-2);
	document.getElementById("textColorProperty").textContent=c;
	attributes+="color:"+c+";";
	
	R=document.getElementById("bgR").value;
	G=document.getElementById("bgG").value;
	B=document.getElementById("bgB").value;
	var bgopacity=document.getElementById("textBGOpacityProperty").value/10;
	document.getElementById("textBGOpacityLabel").textContent=bgopacity;
	
	document.getElementById("textPreview").style.backgroundColor="rgba("+R+","+G+","+B+","+bgopacity+")";
	attributes+="background-color:rgba("+R+","+G+","+B+","+bgopacity+")";
	c="#";
	c+=("0"+Number(R).toString(16)).slice(-2);
	c+=("0"+Number(G).toString(16)).slice(-2);
	c+=("0"+Number(B).toString(16)).slice(-2);
	document.getElementById("textBGColorProperty").textContent=c;
}

var callback;
function textPropertiesShow(cb, v) {
	callback=cb;
	if(v!="") {
		document.getElementById("textStyleProperty").checked=false;
		document.getElementById("textWeightProperty").checked=false;
		
		var lines=v.split(';');
		for(i=0; i<lines.length; i++) {
			var entry=lines[i].split(':');
			entry[1]=entry[1].trim();
			if(entry[0]=='font') {
				var attrs=entry[1].split(' ');
				for(j=0; j<attrs.length; j++) {
					if(attrs[j]=='italic') document.getElementById("textStyleProperty").checked=true;
					else if(attrs[j]=='bold') document.getElementById("textWeightProperty").checked=true;
					else if(!isNaN(attrs[j].substr(0, 1))) document.getElementById("textSizeProperty").value=attrs[j].substr(0, attrs[j].length-2);
					else {
						var fam=attrs[j].replace(/_/g, " ");
						fam=fam.replace("'", "");
						fam=fam.replace("'", "");
						document.getElementById("textFontProperty").value=fam;
					}
				}
			}
			else if(entry[0]=='text-align') {
				document.getElementById("textAlignProperty").value=entry[1];
			}
			else if(entry[0]=='color') {
				var val=entry[1].slice(-6);
				var r=parseInt(val.substr(0, 2), 16);
				var g=parseInt(val.substr(2, 2), 16);
				var b=parseInt(val.substr(4, 2), 16);
				document.getElementById("fgR").value=r;
				document.getElementById("fgG").value=g;
				document.getElementById("fgB").value=b;
			}
			else if(entry[0]=='background-color') {
				var val=entry[1].slice(5);
				val=val.substr(0, val.length-1);
				var values=val.split(',');
				document.getElementById("bgR").value=values[0];
				document.getElementById("bgG").value=values[1];
				document.getElementById("bgB").value=values[2];
				document.getElementById("textBGOpacityProperty").value=(values[3]*10);
			}
		}
	} else {
		document.getElementById("textPreview").style.font='12px Arial';
		document.getElementById("textPreview").style.color='#444444';
		document.getElementById("textPreview").style.backgroundColor='rgba(0, 0, 0, 0.4)';
	}
	textPropertiesChanged();
	document.getElementById("textProperties").style.display='block';
}

function closeTextProperties() {
	document.getElementById("textProperties").style.display="none";
}

var attributes='';
function applyTextProperties() {
	callback(attributes);
	closeTextProperties();
}
</script>
<div id='textProperties' class='trnsdiv'>
	<div class='divForm' style="max-width: 650px; width: 100%;">
		<div class='caption'>Text properties</div>
		<div id='textPreview' style='margin: 10px 20px 10px 20px; padding: 5px; border: 1px solid #cccccc;'>The quick brown fox...</div>
		<div class="disch">
			<b>Font</b>
			<select id='textFontProperty' onChange='textPropertiesChanged();'>
				<option value="Helvetica">Arial</option>
				<option value="Arial Black">Arial Black</option>
				<option value="Comic Sans MS">Comic Sans MS</option>
				<option value="Impact">Impact</option>
				<option value="Lucida">Lucida</option>
				<option value="Tahoma">Tahoma</option>
				<option value="Verdana">Verdana</option>
				<option value="Georgia">Georgia</option>
				<option value="Times New Roman">Times New Roman</option>
				<option value="Courier New">Courier New</option>
				<option value="Lucida Console">Lucida Console</option>
			</select>&emsp;
			Size&nbsp;<span id='textSizeLabel'></span>&emsp;
			<input type="range" min="10" max="40" value="12" id="textSizeProperty" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'>&emsp;
			Bold&nbsp;<input id='textWeightProperty' type='checkbox' onChange='textPropertiesChanged();'>&emsp;
			Italic&nbsp;<input id='textStyleProperty' type='checkbox' onChange='textPropertiesChanged();'><br/>
			<b>Alignement</b>
			<select id='textAlignProperty' onChange='textPropertiesChanged();'>
				<option value="left">Left</option>
				<option value="center">Center</option>
				<option value="right">Right</option>
			</select><br/>
			<b>Color:</b>&nbsp;<span id='textColorProperty'>&nbsp;</span><br/>
			R&nbsp;<input type="range" min="0" max="255" value="0" id="fgR" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'>&nbsp; 
			G&nbsp;<input type="range" min="0" max="255" value="0" id="fgG" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'>&nbsp; 
			B&nbsp;<input type="range" min="0" max="255" value="0" id="fgB" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'><br/>
			<b>BG&nbsp;color:</b>&nbsp;<span id='textBGColorProperty'>&nbsp;</span><br/>
			R&nbsp;<input type="range" min="0" max="255" value="0" id="bgR" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'>&nbsp; 
			G&nbsp;<input type="range" min="0" max="255" value="0" id="bgG" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'>&nbsp; 
			B&nbsp;<input type="range" min="0" max="255" value="0" id="bgB" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'><br/>
			<b>BG&nbsp;opacity:</b>&nbsp;<span id='textBGOpacityLabel'></span><br/>
			&emsp;<input type="range" min="0" max="10" value="4" id="textBGOpacityProperty" onInput='textPropertiesChanged();' onChange='textPropertiesChanged();'><br/>
		</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<p style='clear: both;'>
				 <span class='button' onClick='applyTextProperties();'>&nbsp;OK</span>
				 &emsp;&emsp;
				 <span class='button' onClick='closeTextProperties();'>&nbsp;Cancel</span>
				 &emsp;
			</p>
		</div>
	</div><br/>
</div>

<!-- End Text Properties -->

<script>
var xhr1;
var p;
var noButtons=false;
function enableButtons() {
	noButtons=false;
	document.getElementById('file').disabled=false;
	document.getElementById('sizePresets').classList.remove('buttondisabled');
	document.getElementById('sendButt').classList.remove('buttondisabled');
	document.getElementById('closeUploadForm').classList.remove('buttondisabled');
	document.getElementById('sizePresets').classList.add('button');
	document.getElementById('sendButt').classList.add('button');
	document.getElementById('closeUploadForm').classList.add('button');
}

function disableButtons() {
	noButtons=true;
	document.getElementById('file').disabled=true;
	document.getElementById('sizePresets').classList.remove('button');
	document.getElementById('sendButt').classList.remove('button');
	document.getElementById('closeUploadForm').classList.remove('button');
	document.getElementById('sizePresets').classList.add('buttondisabled');
	document.getElementById('sendButt').classList.add('buttondisabled');
	document.getElementById('closeUploadForm').classList.add('buttondisabled');
}

function sendFile() {
	if(noButtons) return;
	
	//log("Timer started");
	if(!document.getElementById('file').files[0]) return;
		
	document.getElementById('steps').innerHTML="Uploading file, please wait...<br/>";
	disableButtons();
	
	var fd = new FormData();
	fd.append("file", document.getElementById('file').files[0]);
	fd.append("outputWidth", document.getElementById('outputWidth').value);
	xhr = new XMLHttpRequest();
	
	xhr.upload.onprogress = uploadProgress;
	
	xhr.timeout=1000*1000;
	xhr.open("POST", "upload.php");
	xhr.timeout=1000*1000;	// For IE 10
	xhr.send(fd);
}

function uploadProgress(evt) {
	if (evt.lengthComputable) {
		var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		if(percentComplete>95) document.getElementById('steps').innerHTML="Preparing file processing...<br/>";
		if(percentComplete>98) p=setTimeout("checkProgress()", 5000);
		document.getElementById('progressBar').style.width = (percentComplete*4)+"px";
		//document.getElementById('progressBar').innerHTML = percentComplete.toString() + '%';
	}
}

function progressCallBack() {
	//log("Tick");
	if (xhr1.readyState==4) {
		var r=xhr1.responseText;
		if(r=="Finished") {
			clearInterval(p);
			document.getElementById('file').value=null;
			enableButtons();
			document.getElementById('steps').innerHTML="Finished<br/>";
		} else {
			document.getElementById('steps').innerHTML="Processed: "+r+"<br/>";
			p=setTimeout("checkProgress()", 5000);
		}
	}
}

function checkProgress() {
	var file=document.getElementById('file').files[0].name;
	var q="getProgress.php?user=<?php echo $user; ?>&file="+file;
	
	xhr1=new XMLHttpRequest();
	xhr1.onreadystatechange=progressCallBack;
	xhr1.open("GET", q, true);
	xhr1.send(null);
}

function closeUploadForm() {
	if(noButtons) return;
	document.getElementById('uploadForm').style.display='none';
	location.href="";
}
</script>
<div id='uploadForm' class='trnsdiv'>
	<br /><br />
	<div class='divForm' style="width: 500px;">
		<div class='caption'>Processing file</div>
		<div  class="disch">
			<br/>
			<div style='margin: 0 auto; padding: 1px 2px 0px 2px; width: 404px; height: 18px; background-color: #202020;'>
				<div id='progressBar' class='progressBar'></div>
			</div>
			<div id='steps' style='margin: 0 auto; padding: 4px 2px 0px 2px; width: 402px; height: 60px; text-align: center;'>&nbsp;</div>
			Width (size)&emsp;
			<!-- Combo with text input -->
			<input id='outputWidth' type='text' style='width: 80px' maxlength="3" value='300'><span id='sizePresets' class='button' onClick='_dropCombo();'>&ensp;&vellip;&ensp;</span>
			<select id='selInput' style='background-color: white; position: absolute; display: none; width: 80px' onClick='_comboClicked();' onBlur='_hideCombo();' size=5>
				<option value='100'>100</option>
				<option value='150'>150</option>
				<option value='200'>200</option>
				<option value='250'>250</option>
				<option value='300'>300</option>
				<option value='350'>350</option>
				<option value='400'>400</option>
			</select>
			<script>
				var txtInput=document.getElementById('outputWidth');
				var selInput=document.getElementById('selInput');
				
				function _dropCombo() {
					selInput.style.display='block';
					var btn=document.getElementById('sizePresets');
					selInput.style.left=btn.offsetLeft+"px";
					selInput.style.top=btn.offsetTop+"px";
					selInput.focus();
				}
				
				function _hideCombo() {
					selInput.style.display='none';
				}
				
				function _comboClicked(c) {
					outputWidth.value=selInput.options[selInput.selectedIndex].value;
					selInput.style.display='none';
				}
			</script>
			<br/>
			File&emsp;<input type='file' id='file' name='file' size=40><br/><br/>
			<div class='warning' style='padding-left: 10px;'>
				After hitting the 'Add' button, the video processing cannot be interrupted or canceled. Not even by refreshing or closing your browser.
			</div><br/>
		</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<span id='sendButt' class='button' onClick='sendFile();'>Add</span>&emsp;&emsp;
			<span id='closeUploadForm' class='button' onClick='closeUploadForm();'>Close</span>&emsp;&emsp;
		</div>
	</div><br/>
</div>

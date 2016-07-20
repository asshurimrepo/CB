<script>
function deleteVideo(id) {
	var delConfirm=confirm("Are you sure you want to delete this video?");
	if(!delConfirm) return;
	
	var fd = new FormData();
	fd.append("vid", id);

	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", delVideoResponse, false);

	xhr.open("POST", "del.php");
	xhr.send(fd);
}

function delVideoResponse() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(r!="OK") alert("Video deletion failed!\n"+r);
        else location.href="";
	}
}

var forPreview=true;
function viewVideo(videoUID) {
	loadVideo(videoUID);
}

function showUpload() {
	document.getElementById('file').value=null;
	enableButtons();
	document.getElementById('uploadForm').style.display='block';
}

var optinW=400;
var optinH=200;
function showActions(id, w, h) {
	optinW=w;
	optinH=h;
	
	document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
	loadActions(id);
	document.getElementById('actionsForm').style.display='block';
}

function showProperties(id) {
	document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
	loadProperties(id);
	document.getElementById('propertiesForm').style.display='block';
}

function showEmbedCode(id, vid) {
	document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
	var ttt="&lt;script src='http://www.casterbuddy.com/loader.js'&gt;&lt;/script&gt;\n&lt;script&gt;loadVideo(\""+vid+"\");&lt;/script&gt;";
	document.getElementById('embedCode').innerHTML=ttt;
	document.getElementById('embedForm').style.display='block';
}

</script>
<input type='hidden' id='act' name='act' value='upload'>

<div style='margin-top: 20px;'>User: <b><?php echo $user; ?></b>&emsp;<a href='javascript: logout();'>[Disconnect]</a></div>
<br />

<div style='max-width: 1280px; display: flex; flex-direction: row; flex-wrap: wrap; margin: auto;'>
<?php
	$q="SELECT * FROM projects WHERE UserId=".$user_id." ORDER BY id";
	$prjs=mysqli_query($conn, $q);
	
	while($prj=mysqli_fetch_assoc($prjs)) {
		$basename=substr($prj['FileName'], 0, strpos($prj['FileName'], "."));
		
		echo "<div id='tr".$prj['id']."' class='col-3 col-m-12 vignette'>\n";
		echo "<span class='button' style='background-color: #00659c;' onClick='showProperties(".$prj['id'].");' title='Options'><img src='images/properties.png' style='vertical-align: middle;'>Options</span>\n";
		echo "<span class='button' style='background-color: #00b827;' onClick='showActions(".$prj['id'].", ".$prj['Width'].", ".$prj['Height'].");' title='Actions'><img src='images/edit.png' style='vertical-align: middle;'>Actions</span>\n";
		echo "<span class='button' style='background-color: #d92f2e;' onClick='deleteVideo(".$prj['id'].");' title='Delete'><img src='images/del.png' style='vertical-align: middle;'>Del</span>\n";
		echo "<img style='margin-top: 8px; margin-bottom: 8px;' src='data/".$user."/done/".$prj['uid'].".png' class='thumb' onClick=\"viewVideo('".$prj['uid']."', ".$prj['Width'].", ".$prj['Height'].");\", title='View'><br/>\n";
		echo "<span class='button' style='background-color: #ffffff; color: #888888;' onClick=\"showEmbedCode(".$prj['id'].", '".$prj['uid']."');\" title='Embedding code'><img src='images/copy.png' style='vertical-align: middle;'>Click me to copy</span>\n";
		echo "</div>\n";
	}
?>

</div>
<br />

<div style='text-align: center;'>
	<span class='button' onClick='showUpload();'>&nbsp;Upload your video</span>&emsp;or&emsp;
	<span class='button' onClick="location.replace('premade.php');">&nbsp;Add a premade video</span>
</div>
<br/>

<script src='loader.js'></script>

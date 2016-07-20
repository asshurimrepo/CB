<!-- The actions -->
<script>
var vid=0;
function loadActionsResponse() {
    if (xhr.readyState==4) {
        var data=xhr.responseText;
        if(data=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(data.length>0) {
			var lines=data.split("\n");
			for(i=0; i<lines.length; i++) {
				var line=lines[i].split("=");
				
				if(line[0]=="title") document.getElementById("actionsTitle").innerHTML=line[1];
				
				else if(line[0]=="linkURL") document.getElementById("linkURL").value=line[1];
				
				else if(line[0]=="textLine1") document.getElementById("textLine1").value=line[1];
				else if(line[0]=="textLine2") document.getElementById("textLine2").value=line[1];
				else if(line[0]=="textPosition") document.getElementById("textPosition").value=line[1];
				else if(line[0]=="textShowSec") document.getElementById("textShowSec").value=line[1];
				else if(line[0]=="textShowDuration") document.getElementById("textShowDuration").value=line[1];
				else if(line[0]=="textStyling") textStyle=line[1];
				
				else if(line[0]=="phoneNumber") document.getElementById("phoneNumber").value=line[1];
				else if(line[0]=="phonePosition") document.getElementById("phonePosition").value=line[1];
				else if(line[0]=="phoneShowSec") document.getElementById("phoneShowSec").value=line[1];
				else if(line[0]=="phoneShowDuration") document.getElementById("phoneShowDuration").value=line[1];
				else if(line[0]=="phoneStyling") phoneStyle=line[1];
				
				else if(line[0]=="buttonLabel") document.getElementById("buttonLabel").value=line[1];
				else if(line[0]=="buttonCode") { buttCode=atob(line[1]); document.getElementById('codeSample1').textContent=buttCode.substr(0, 40)+"..."; }
				else if(line[0]=="buttonPosition") document.getElementById("buttonPosition").value=line[1];
				else if(line[0]=="buttonShowSec") document.getElementById("buttonShowSec").value=line[1];
				else if(line[0]=="buttonShowDuration") document.getElementById("buttonShowDuration").value=line[1];
				else if(line[0]=="buttonStyling") buttonStyle=line[1];
				
				else if(line[0]=="formCode") { formCode=atob(line[1]); document.getElementById('codeSample0').textContent=formCode.substr(0, 40)+"..."; }
				else if(line[0]=="formShowSec") document.getElementById("formShowSec").value=line[1];
				else if(line[0]=="formShowDuration") document.getElementById("formShowDuration").value=line[1];
			}
		}
    }
}

function loadActions(id) {
	vid=id;
	
	document.getElementById("actionsTitle").value="";
	document.getElementById("linkURL").value="";
	document.getElementById("textLine1").value="";
	document.getElementById("textLine2").value="";
	document.getElementById("textPosition").value=0;
	document.getElementById("textShowSec").value="0";
	document.getElementById("textShowDuration").value="-1";
	textStyle='';
	
	document.getElementById("phoneNumber").value="";
	document.getElementById("phonePosition").value=0;
	document.getElementById("phoneShowSec").value="0";
	document.getElementById("phoneShowDuration").value="-1";
	phoneStyle='';
	
	buttCode="";
	document.getElementById("buttonLabel").value="";
	document.getElementById('codeSample1').textContent="";
	document.getElementById("buttonPosition").value=0;
	document.getElementById("buttonShowSec").value="0";
	document.getElementById("buttonShowDuration").value="-1";
	buttonStyle='';
	
	formCode="";
	document.getElementById('codeSample0').textContent="";
	document.getElementById("formShowSec").value="0";
	document.getElementById("formShowDuration").value="-1";
	
	document.getElementById("save_error").innerHTML="";
	
	var fd = new FormData();
	fd.append("vid", vid);
	
	xhr = new XMLHttpRequest();
	
	xhr.addEventListener("load", loadActionsResponse, false);
	
	xhr.open("POST", "loadActions.php");
	xhr.send(fd);
}

function saveActionsResponse() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r=="Login") location.replace('<?php echo $_ROOT_; ?>');
        if(r=="OK") closeActions();
        else document.getElementById("save_error").innerHTML=r;
	}
}

function saveActions() {
	var data="linkURL="+document.getElementById("linkURL").value+"\n";
	data+="textLine1="+document.getElementById("textLine1").value+"\n";
	data+="textLine2="+document.getElementById("textLine2").value+"\n";
	var el=document.getElementById("textPosition");
	data+="textPosition="+el.options[el.selectedIndex].value+"\n";
	data+="textShowSec="+document.getElementById("textShowSec").value+"\n";
	data+="textShowDuration="+document.getElementById("textShowDuration").value+"\n";
	data+="textStyling="+textStyle+"\n";
	
	data+="phoneNumber="+document.getElementById("phoneNumber").value+"\n";
	var el=document.getElementById("phonePosition");
	data+="phonePosition="+el.options[el.selectedIndex].value+"\n";
	data+="phoneShowSec="+document.getElementById("phoneShowSec").value+"\n";
	data+="phoneShowDuration="+document.getElementById("phoneShowDuration").value+"\n";
	data+="phoneStyling="+phoneStyle+"\n";
	
	data+="buttonLabel="+document.getElementById("buttonLabel").value+"\n";
	data+="buttonCode="+btoa(buttCode)+"\n";
	el=document.getElementById("buttonPosition");
	data+="buttonPosition="+el.options[el.selectedIndex].value+"\n";
	data+="buttonShowSec="+document.getElementById("buttonShowSec").value+"\n";
	data+="buttonShowDuration="+document.getElementById("buttonShowDuration").value+"\n";
	data+="buttonStyling="+buttonStyle+"\n";
	
	data+="formCode="+btoa(formCode)+"\n";
	data+="formShowSec="+document.getElementById("formShowSec").value+"\n";
	data+="formShowDuration="+document.getElementById("formShowDuration").value+"\n";
	//alert(data);
	
	var fd = new FormData();
	fd.append("vid", vid);
	fd.append("data", data);

	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", saveActionsResponse, false);

	xhr.open("POST", "saveActions.php");
	xhr.send(fd);
}

function closeActions() {
	document.getElementById("actionsForm").style.display="none";
	location.href="";
}

function showCodeForm(v) {
	target=v;
	if(v==0) codeArea.value=formCode; else codeArea.value=buttCode;
	document.getElementById("codeForm").style.display='block';
}

function showCustomizeForm() {
	layoutChanged();
	document.getElementById("customizeForm").style.display='block';
}

var textStyle='font:bold 14px helvetica;color:#0000ff;background-color:rgba(88,88,88,0.2)';
function cbTextProperties(s) {
	textStyle=s;
}

function showTextProperties() {
	textPropertiesShow(cbTextProperties, textStyle);
}

var phoneStyle='font:bold 14px helvetica;color:#0000ff;background-color:rgba(88,88,88,0.2)';
function cbPhoneProperties(s) {
	phoneStyle=s;
}

function showPhoneProperties() {
	textPropertiesShow(cbPhoneProperties, phoneStyle);
}

var buttonStyle='font:bold 14px helvetica;color:#444444;background-color:rgba(222,222,222,1)';
function cbButtonProperties(s) {
	buttonStyle=s;
	buttCode="<span style=\"position:absolute;";
	if(buttonStyle.indexOf('text-align:left')>=0) buttCode+="left:5px;";
	else if(buttonStyle.indexOf('text-align:right')>=0) buttCode+="right:5px;";
	else buttCode+="margin:0 auto;";
	buttCode+="padding:3px;border:1px solid gray;cursor:pointer;"+buttonStyle+"\" onClick=\"alert('Button pushed');\">"+document.getElementById("buttonLabel").value+"</span>";
	document.getElementById('codeSample1').textContent=buttCode.substr(0, 40)+'...';
}

function showButtonProperties() {
	textPropertiesShow(cbButtonProperties, buttonStyle);
}
</script>
<div id='actionsForm' class='trnsdiv'>
	<div class='divForm' style="max-width: 600px; width: 100%;margin-top: 140px;">
		<div class='caption'>Actions</div>
		<div id='actionsTitle' class="disch">&nbsp;</div>
		<div class="disch">
			<h3>&ensp;Link URL</h3>
			Link <input id='linkURL' type='text' size=50><br/>
		</div>
		<div class="disch">
			<h3>&ensp;Text overlay</h3>
			Line 1 <input id='textLine1' type='text' size=50><br/>
			Line 2 <input id='textLine2' type='text' size=50><br/>
			Vertical alignment
			<select id='textPosition'><option value=0>Bottom</option><option value=1>Middle</option><option value=2>Top</option></select>&emsp;
			<span class='button' onClick='showTextProperties();'>&nbsp;Style it</span><br/>
			Start time <input id='textShowSec' type='text' size=5> &emsp;&emsp; Duration <input id='textShowDuration' type='text' size=5>
		</div>
		<div class="disch">
			<h3>&ensp;Click to call</h3>
			Phone# <input id='phoneNumber' type='text' size=50><br/>
			Vertical alignment
			<select id='phonePosition'><option value=0>Bottom</option><option value=1>Middle</option><option value=2>Top</option></select>&emsp;
			<span class='button' onClick='showPhoneProperties();'>&nbsp;Style it</span><br/>
			Start time <input id='phoneShowSec' type='text' size=5> &emsp;&emsp; Duration <input id='phoneShowDuration' type='text' size=5>
		</div>
		<div class="disch">
			<h3>&ensp;Button overlay</h3>
			Label <input id='buttonLabel' type='text' size=20><br/>
			Vertical alignment
			<select id='buttonPosition'><option value=0>Bottom</option><option value=1>Middle</option><option value=2>Top</option></select>&emsp;
			<span class='button' onClick='showButtonProperties();'>&nbsp;Style it</span><br/>
			[<pre id='codeSample1' style='display: inline-block;'>&nbsp;</pre>]&nbsp;
			<span class='button' onClick='showCodeForm(1);'>&nbsp;Edit code</span><br/>
			Start time <input id='buttonShowSec' type='text' size=5> &emsp;&emsp; Duration <input id='buttonShowDuration' type='text' size=5>
		</div>
		<div class="disch">
			<h3>&ensp;Form overlay</h3>
			[<pre id='codeSample0' style='display: inline-block;'>&nbsp;</pre>]&nbsp;
			<span class='button' onClick='showCodeForm(0);'>&nbsp;Edit code</span>&emsp;
			<span class='button' onClick='showCustomizeForm();'>&nbsp;Custom form</span><br/>
			Start time <input id='formShowSec' type='text' size=5> &emsp;&emsp; Duration <input id='formShowDuration' type='text' size=5>
		</div>
		<div id='save_error' class='error'>&nbsp;</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<p style='clear: both;'>
				 <span class='button' onClick='saveActions();'>&nbsp;Save</span>
				 &emsp;&emsp;
				 <span class='button' onClick='closeActions();'>&nbsp;Cancel</span>
				 &emsp;
			</p>
		</div>
	</div><br/>
</div>
<!-- End actions -->

<!-- Code enter form -->
<script>
var target=0;	// 0=form code, 1=button code
var buttCode="";
var formCode="";
function closeCodeForm() {
	document.getElementById("codeForm").style.display="none";
}
function okcloseCodeForm() {
	if(target==0) {
		formCode=codeArea.value;
		document.getElementById('codeSample0').textContent=formCode.substr(0, 40)+'...';
	} else {
		buttCode=codeArea.value;
		document.getElementById('codeSample1').textContent=buttCode.substr(0, 40)+'...';
	}
	closeCodeForm();
}
</script>
<div id='codeForm' class='trnsdiv'>
	<div class='divForm' style="max-width: 500px; width: 100%;">
		<div class='caption'>Enter code</div>
		<div class="disch">
			<textarea id='codeArea' placeholder='Enter your code here' cols=50 rows=20 style='font-family: monospace;'></textarea>
		</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<p style='clear: both;'>
				 <span class='button' onClick='okcloseCodeForm()'>&nbsp;OK</span>
				 &emsp;&emsp;
				 <span class='button' onClick='closeCodeForm();'>&nbsp;Cancel</span>
				 &emsp;
			</p>
		</div>
	</div><br/>
</div>
<script>
var codeArea=document.getElementById('codeArea');
</script>
<!-- End code enter form -->

<!-- Custom form generator -->
<script>
function layoutChanged() {
	document.getElementById('optinContainer').style.width=optinW+"px";
	document.getElementById('optinContainer').style.height=optinH+"px";
	
	document.getElementById('cb_optin_title').innerHTML=document.getElementById('optin_title').value;
	
	var titleFont=document.getElementById('optin_font');
	var titleSize=document.getElementById('optin_title_size');
	var titleColor=document.getElementById('optin_title_color');
	var titleStyle=document.getElementById('optin_title_style');
	
	var el=document.getElementById('cb_optin_title');
	el.style.font=titleStyle.value+" "+titleSize.value+" "+titleFont.value;
	el.style.color=titleColor.value;
	
	var inpSize=document.getElementById('optin_inp_size');
	var inpColor=document.getElementById('optin_inp_color');
	var inpBorder=document.getElementById('optin_inp_border');
	
	el=document.getElementById('cb_optin_nameBox');
	el.style.fontSize=inpSize.value;
	el.style.color="#888888"; //inpColor.value;
	el.style.border=inpBorder.value+" solid "+inpColor.value;
	el.style.backgroundColor="rgba(255, 255, 255, 0.5)";
	
	el=document.getElementById('cb_optin_emailBox');
	el.style.fontSize=inpSize.value;
	el.style.color="#888888"; //inpColor.value;
	el.style.border=inpBorder.value+" solid "+inpColor.value;
	el.style.backgroundColor="rgba(255, 255, 255, 0.5)";
	
	var buttSize=document.getElementById('optin_butt_size');
	var buttColor=document.getElementById('optin_butt_color');
	var buttBGColor=document.getElementById('optin_butt_bgcolor');
	var buttBorder=document.getElementById('optin_butt_border');
	var buttCaption=document.getElementById('optin_butt_caption');
	
	el=document.getElementById('cb_optin_submitButton');
	el.style.fontSize=buttSize.value;
	el.style.color=buttColor.value;
	el.style.backgroundColor=buttBGColor.value;
	el.style.border=buttBorder.value+" solid "+buttColor.value;
	el.value=buttCaption.value;
}
function closeFormGenerator() {
	document.getElementById("customizeForm").style.display="none";
}
function okcloseFormGenerator() {
	var ar=document.getElementById('cb_optin_selectAR').selectedIndex;
	//for(i=0; i<s.length; i++) s[i]=s[i].replace(/([A-Z])/g, "-$1").toLowerCase();

	var titleFont=document.getElementById('optin_font').value;
	var titleSize=document.getElementById('optin_title_size').value;
	var titleColor=document.getElementById('optin_title_color').value;
	var titleStyle=document.getElementById('optin_title_style').value;
	var titleCSS="style='font: "+titleStyle+" "+titleSize+" "+titleFont+"; color: "+titleColor+";'";
	
	var inpSize=document.getElementById('optin_inp_size').value;
	var inpColor=document.getElementById('optin_inp_color').value;
	var inpBorder=document.getElementById('optin_inp_border').value;
	var inpCSS="style='margin: 5px; padding: 5px; font-size: "+inpSize+"; border: "+inpBorder+" solid "+inpColor+"; color: #666666; background-color: rgba(255, 255, 255, 0.5);'";
	
	var buttSize=document.getElementById('optin_butt_size').value;
	var buttColor=document.getElementById('optin_butt_color').value;
	var buttBGColor=document.getElementById('optin_butt_bgcolor').value;
	var buttBorder=document.getElementById('optin_butt_border').value;
	var buttCSS="style='margin: 5px; padding: 5px; font-size: "+buttSize+"; border: "+buttBorder+" solid "+buttColor+"; color: "+buttColor+"; background-color: "+buttBGColor+";'";
	
	var form="";
	var id=document.getElementById('cb_optin_uid').value;
	var list=document.getElementById('cb_optin_maillist').value;
	var name=document.getElementById('cb_optin_nameBox').value;
	var email=document.getElementById('cb_optin_emailBox').value;
	var redir=document.getElementById('cb_optin_redir').value;
	var submit=document.getElementById('optin_butt_caption').value;
	var additional="";
	
	var theCode="<div style='width: "+optinW+"px; height: "+optinH+"px; margin: 0 auto; padding: 10px; text-align: center;'>\n";
	theCode+="<div style='position: absolute; left: 0; right: 0; bottom: 0;'>";
	theCode+="<div "+titleCSS+">"+document.getElementById('cb_optin_title').innerHTML+"</div>\n";
	theCode+="<div style='display: flex; flex-direction: column; align-items: center; width: 200px; margin: 0 auto;'>\n";
	
	if(ar==0) {			// AWeber
		form="<form method='post' action='https://www.aweber.com/scripts/addlead.pl'>\n";
		id="<input type='hidden' name='meta_web_form_id' value='"+id+"'/>\n";
		list="<input type='hidden' name='listname' value='"+list+"'/>\n";
		name="<input type='text' name='name' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='email' "+inpCSS+" value='"+email+"'/>\n";
		redir="<input type='hidden' name='redirect' value='"+redir+"'/>\n";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
		additional="<input type='hidden' name='meta_message' value='1'/>\n";
		additional+="<input type='hidden' name='meta_required' value='email'/>\n";
	} else if(ar==1) {	// MailChimp
		form="<form action='//104.us12.list-manage.com/subscribe/post?u="+list+"&amp;id="+id+"' method='post' name='mc-embedded-subscribe-form' target='_blank' novalidate>\n";
		id="";
		list="";
		name="<input type='text' name='FNAME' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='EMAIL' "+inpCSS+" value='"+email+"'/>\n";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
	} else if(ar==2) {	// GetResponse
		form="<form action='https://app.getresponse.com/add_subscriber.html' method='post'>\n";
		id="<input type='hidden' name='campaign_token' value='"+id+"'/>\n";
		list="";
		name="<input type='text' name='name' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='email' "+inpCSS+" value='"+email+"'/>\n";
		redir="<input type='hidden' name='thankyou_url' value='"+redir+"'/>\n";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
	} else if(ar==3) {	// Sendlane
		form="<form method='POST' action='http://rsteels.sendlane.com/form/1'>\n";
		id="<input name='_token' type='hidden' value='"+id+"'>\n";
		list="";
		name="<input type='text' name='form_field[1]' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='form_field[3]' "+inpCSS+" value='"+email+"'/>\n";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
	} else if(ar==4) {	// SendReach
		form="<form action='http://dashboard.sendreach.com/index.php/lists/"+id+"/subscribe' method='post' target='_blank'>\n";
		id="";
		list="";
		name="<input type='text' name='FNAME' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='EMAIL' "+inpCSS+" value='"+email+"'/>\n";
		redir="";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
	} else if(ar==5) {	// ConstantContact
		form="<form name='embedded_signup' method='POST' action='https://visitor2.constantcontact.com/api/signup'>\n";
		id="<input type='hidden' name='ca' value='"+id+"'/>\n";
		list="<input type='hidden' name='list' value='"+list+"'/>\n";
		additional="<input type='hidden' name='source' value='EFD'/>\n";
		additional+="<input type='hidden' name='url' value='http://37.252.121.104/'/>\n";
		name="<input type='text' name='first_name' "+inpCSS+" value='"+name+"'/>\n";
		email="<input type='text' name='email' "+inpCSS+" value='"+email+"'/>\n";
		submit="<input type='submit' name='submit' "+buttCSS+" value='"+submit+"'/>\n";
	}
	
	theCode+=form;
	theCode+=id;
	theCode+=list;
	theCode+=name;
	theCode+=email;
	theCode+=redir;
	theCode+=submit;
	theCode+=additional;
	theCode+="</form>\n";
	theCode+="</div>\n";
	theCode+="</div>\n";
	theCode+="</div>\n";
	
	formCode=theCode;
	codeArea.value=theCode;
	document.getElementById('codeSample0').textContent=formCode.substr(0, 40)+'...';
	
	closeFormGenerator();
}
</script>
<div id='customizeForm' class='trnsdiv'>
	<div class='divForm' style="max-width: 500px; width: 100%;">
		<div class='caption'>Create custom form</div>
		<div class="disch">
			<div id='optinContainer' style='position: relative; width: 400px; height: 200px; margin: 0 auto; background-color: #f0f0f0; padding: 10px; text-align: center;'>
			<div style='position: absolute; left: 0; right: 0; bottom: 0;'>
			<div id='cb_optin_title'>&nbsp;</div>
			<div id='cb_optin_div' style='display: flex; flex-direction: column; align-items: center; width: 200px; margin: 0 auto;'>
			<input type='text' id='cb_optin_nameBox' style='margin: 5px; padding: 5px; color: #666666;' placeholder='Enter your name' value=''/>
			<input type='text' id='cb_optin_emailBox' style='margin: 5px; padding: 5px; color: #666666;' placeholder='Enter your email' value=''/>
			<input type='submit' id='cb_optin_submitButton' style='margin: 5px; padding: 5px; font-weight: bold;' value='Submit'/>
			</div>
			</div>
			</div>
			<div style='border-bottom: 1px solid #aaaaaa; font-weight: bold;'>Title</div>
			Text&nbsp;
			<input type='text' id='optin_title' placeholder='Enter your name' size='40' value='Optin form title' onKeyUp='layoutChanged();'/>&ensp;
			Font&nbsp;
			<select id='optin_font' onChange='layoutChanged();'>
				<option value='sans-serif'>Sans-serif</option>
				<option value='serif'>Serif</option>
				<option value='fantasy'>Fantasy</option>
				<option value='cursive'>Cursive</option>
				<option value='monospace'>Monospace</option>
			</select><br/>
			
			Size&nbsp;
			<select id='optin_title_size' onChange='layoutChanged();'>
				<option value='12px'>Small</option>
				<option value='16px' selected>Mid</option>
				<option value='20px'>Large</option>
			</select>&emsp;
			Color&nbsp;
			<select id='optin_title_color' onChange='layoutChanged();'>
				<option value='#000000'>Black</option>
				<option value='#ffffff'>White</option>
				<option value='#aaaaaa'>Gray</option>
				<option value='#ff4444'>Red</option>
				<option value='#44ff44'>Green</option>
				<option value='#4444ff' selected>Blue</option>
				<option value='#ffff44'>Yellow</option>
				<option value='#ff44ff'>Magenta</option>
				<option value='#ffaaaa'>Pink</option>
				<option value='#44ffff'>Cyan</option>
			</select>&emsp;
			Style&nbsp;
			<select id='optin_title_style' onChange='layoutChanged();'>
				<option value='normal'>Normal</option>
				<option value='bold' selected>Bold</option>
				<option value='italic'>Italic</option>
				<option value='italic bold'>Bold italic</option>
			</select><br/>
			
			<div style='border-bottom: 1px solid #aaaaaa; font-weight: bold;'>Inputs</div>
			Size&nbsp;
			<select id='optin_inp_size' onChange='layoutChanged();'>
				<option value='12px'>Small</option>
				<option value='16px'>Mid</option>
				<option value='20px'>Large</option>
			</select>&emsp;
			Color&nbsp;
			<select id='optin_inp_color' onChange='layoutChanged();'>
				<option value='#000000'>Black</option>
				<option value='#ffffff'>White</option>
				<option value='#aaaaaa'>Gray</option>
				<option value='#ff4444'>Red</option>
				<option value='#44ff44'>Green</option>
				<option value='#4444ff' selected>Blue</option>
				<option value='#ffff44'>Yellow</option>
				<option value='#ff44ff'>Magenta</option>
				<option value='#ffaaaa'>Pink</option>
				<option value='#44ffff'>Cyan</option>
			</select>&emsp;
			Border&nbsp;
			<select id='optin_inp_border' onChange='layoutChanged();'>
				<option value='1px' selected>1px</option>
				<option value='2px'>2px</option>
				<option value='3px'>3px</option>
			</select><br/>
			
			<div style='border-bottom: 1px solid #aaaaaa; font-weight: bold;'>Button</div>
			Caption&nbsp;
			<input type='text' id='optin_butt_caption' placeholder='Button caption' size='20' value='Subscribe' onKeyUp='layoutChanged();'/>&emsp;
			BG color&nbsp;
			<select id='optin_butt_bgcolor' onChange='layoutChanged();'>
				<option value='#000000'>Black</option>
				<option value='#ffffff'>White</option>
				<option value='#aaaaaa'>Gray</option>
				<option value='#ff4444'>Red</option>
				<option value='#44ff44'>Green</option>
				<option value='#4444ff' selected>Blue</option>
				<option value='#ffff44'>Yellow</option>
				<option value='#ff44ff'>Magenta</option>
				<option value='#ffaaaa'>Pink</option>
				<option value='#44ffff'>Cyan</option>
			</select><br/>
			Size&nbsp;
			<select id='optin_butt_size' onChange='layoutChanged();'>
				<option value='12px'>Small</option>
				<option value='16px'>Mid</option>
				<option value='20px'>Large</option>
			</select>&emsp;
			Color&nbsp;
			<select id='optin_butt_color' onChange='layoutChanged();'>
				<option value='#000000'>Black</option>
				<option value='#ffffff' selected>White</option>
				<option value='#aaaaaa'>Gray</option>
				<option value='#ff4444'>Red</option>
				<option value='#44ff44'>Green</option>
				<option value='#4444ff'>Blue</option>
				<option value='#ffff44'>Yellow</option>
				<option value='#ff44ff'>Magenta</option>
				<option value='#ffaaaa'>Pink</option>
				<option value='#44ffff'>Cyan</option>
			</select>&emsp;
			Border&nbsp;
			<select id='optin_butt_border' onChange='layoutChanged();'>
				<option value='1px'>1px</option>
				<option value='2px'>2px</option>
				<option value='3px'>3px</option>
			</select><br/>
			
			<div style='border-bottom: 1px solid #aaaaaa; font-weight: bold;'>Autoresponder</div>
			Service&nbsp;
			<select id='cb_optin_selectAR'>
				<option value='0'>AWeber</option>
				<option value='1'>MailChimp</option>
				<option value='2'>GetResponse</option>
				<option value='3'>Sendlane</option>
				<option value='4'>SendReach</option>
				<option value='5'>Constant Contact</option>
			</select><br/>
			User ID&nbsp;
			<input type='text' id='cb_optin_uid' placeholder='User ID' size='25'/>&nbsp;
			Mail list&nbsp;
			<input type='text' id='cb_optin_maillist' placeholder='Mail list (if supported)' size='25'/><br/>
			Redirect to&nbsp;
			<input type='text' id='cb_optin_redir' placeholder='Your thank you page' size='25'/><br/>
		</div>
		<div style="line-height: 250%; background-color: white; text-align: right;">
			<p style='clear: both;'>
				 <span class='button' onClick='okcloseFormGenerator()'>&nbsp;OK</span>
				 &emsp;&emsp;
				 <span class='button' onClick='closeFormGenerator();'>&nbsp;Cancel</span>
				 &emsp;
			</p>
		</div>
	</div><br/>
</div>
<script>layoutChanged();</script>
<!-- End custom form generator -->

<!-- Text properties form -->
<?php include("textProperties.inc"); ?>
<!-- End text properties form -->

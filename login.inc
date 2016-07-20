<script>
function loginResponse() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r!="OK") document.getElementById('message1').innerHTML=r;
        else location.href="";
	}
}

function login() {
	var un=document.getElementById('un').value;
	var pw=document.getElementById('pw').value;
	var fd = new FormData();
	fd.append("un", un);
	fd.append("pw", pw);
	xhr = new XMLHttpRequest();

	xhr.addEventListener("load", loginResponse, false);

	xhr.open("POST", "login.php");
	xhr.send(fd);

	//if(document.getElementById('un').value.length<4) return;
	//if(document.getElementById('pw').value.length<8) return;
	
	//document.getElementById('login').submit();
}

function showSignUp() {
	document.getElementById('username').value="";
	document.getElementById('password').value="";
	document.getElementById('email').value="";
	document.getElementById('plan').selectedIndex=1;
	drawCaptcha();
	
	document.getElementById('signupForm').style.display='block';
}
</script>

<div style='margin-top: 20px; text-align: right;'>
<form id='login' action="login.php" method="post">
<input type='text' id='un' name='username' style='width: 200px;' placeholder='User name' value=''>&emsp;
<input type='password' id='pw' name='password' style='width: 200px;' placeholder='Password' onkeypress='(function(e) {if(e.keyCode === 13) login();})(event);'>&emsp;
<span class='button' onClick='login();'>&nbsp;Login</span>&emsp;
<span class='button' onClick='showSignUp();'>&nbsp;Sign up</span>&emsp;
<span id='message1' class='error'>&nbsp;</span>
</form>
<div style="clear: both;"></div>

</div>

<!-- The sign up form -->
<script>
var xhr;
function userAdded() {
    if (xhr.readyState==4) {
        var r=xhr.responseText;
        if(r=="OK") closeSignUp(); else document.getElementById('message').innerHTML=r;
    }
}

function signUp() {
	document.getElementById('message').innerHTML="";
	if(!validCaptcha()) {
		alert("Please fill all the fields");
		return;
	}
	
	var un=document.getElementById('username').value;
	var pw=document.getElementById('password').value;
	var em=document.getElementById('email').value;
	
	var re=/\S+@\S+\.\S+/;
	if(un.length<5) alert("Username must be at least 5 chars long");
	else if(pw.length<8) alert("Password must be at least 8 chars long");
	//else if(em.indexOf(".")<0 || em.indexOf("@")<0) alert("The email address is invalid");
	else if(!re.test(em)) alert("The email address is invalid");
	else {
		var fd = new FormData();
		fd.append("session_token", '<?php echo $session_token; ?>');
		fd.append("username", un);
		fd.append("password", pw);
		fd.append("email", em);
		fd.append("select", document.getElementById('plan'));

		xhr = new XMLHttpRequest();

		xhr.addEventListener("load", userAdded, false);

		xhr.open("POST", "adduser.php");
		xhr.send(fd);
	}
}

function closeSignUp() {
	document.getElementById("signupForm").style.display="none";
}

// Captcha
var code="";

function drawCaptcha() {
	var canvas = document.getElementById("captchaCanvas");
	var ctx = canvas.getContext("2d");
	ctx.fillStyle="#888888";
	ctx.fillRect(0, 0, canvas.width, canvas.height);
	ctx.fillStyle="#AAAAAA";
	document.getElementById("captcha").value="";
	code="";
	for(i=0; i<5; i++) {
		var digit=Math.ceil(Math.random()*9);
		code=code*10+digit;
		var x=i*12+Math.ceil(Math.random()*6);
		var y=15+Math.ceil(Math.random()*10);
		var z=12+Math.ceil(Math.random()*5)+'';
		ctx.font = "bold "+z+"px Times";
		ctx.fillText(digit, x, y);
	}
	code+='';
}

function validCaptcha() {
	var inp=document.getElementById("captcha").value;
	if(inp=='') return false;
	if(inp==code) return true;
	return false;
}
</script>

<div id='signupForm' class='trnsdiv'>
	<div class='divForm' style="max-width: 500px; width: 100%;">
		<div class='caption'>Sign up</div>
		<div class="disch">
			<form id='addUserForm' action="adduser.php" method="post">
			<table style='display: inline-block;'>
			<tr><td style='text-align:right;'>Username</td><td style='text-align:left;'><input type='text' id='username' name='username' size=15 maxlength='30' value=''></td></tr>
			<tr><td style='text-align:right;'>Password</td><td style='text-align:left;'><input type='password' id='password' name='password' size=15 maxlength='30' value=''></td></tr>
			<tr><td style='text-align:right;'>Email</td><td style='text-align:left;'><input type='text' id='email' name='email' size=35 maxlength='100' value=''></td></tr>
			<tr><td style='text-align:right;'>Plan</td><td style='text-align:left;'>
			<select id='plan' name='plan'>
				<option value='0'>Free</option>
				<option value='1' selected>Basic</option>
				<option value='2'>Professional</option>
			</select>
			</tr><tr>
			<td style='text-align:right;'><canvas id="captchaCanvas" width="80" height="30"></canvas></td>
			<td style='text-align:left;'><input type='text' size=10 id='captcha' value='' />
			<input type='button' value='...' size=10 onClick='drawCaptcha();' /></td>
			</tr></table>
			<br/>
			<div id='message' class='error'>&nbsp;</div>
			<div style="line-height: 250%; background-color: white; text-align: right;">
				<p style='clear: both;'>
				<span class='button' onClick='signUp();'>&nbsp;Sign up</span>
				<span class='button' onClick='closeSignUp();'>&nbsp;Close</span>
				</p>
			</div>
			</form>
		</div>
	</div><br/>
</div>
<script>drawCaptcha();</script>
<!-- End sign up form -->

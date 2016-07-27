<div style='position: relative; padding: 0px; margin-top: 5px;'>
	<img src='images/main.jpg' style='margin-top: 5px; width: 100%; max-width: 1280px;'/>
	<a href="javascript: alert('Learn more');"><img src='images/button-orange.png' class='button-onimg'/></a>
</div>

<!-- What - Why - How -->
<div class='main1'>
	<div class='col-4 col-m-12'>
		<img src='images/what.png'><br/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	</div>
	<div class='col-4 col-m-12'>
		<img src='images/why.png'><br/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	</div>
	<div class='col-4 col-m-12'>
		<img src='images/how.png'><br/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	</div>
</div>

<!-- Slider -->
<div id='slider' class='slider'>
	<h2>Some of our work</h2>
	<div class='col-12' style='padding: 0px; margin: 0px;'>
	bla bla bla...
	</div>
	<img src='images/arrowL.png' onClick='slide(-1);'/>
	<a href='javascript: void(0);' onClick='sampleClicked(sliderPos);'><img id='sample1' src='images/sample1.png'/></a>
	<a href='javascript: void(0);' onClick='sampleClicked(sliderPos+1);'><img id='sample2' src='images/sample2.png'/></a>
	<a href='javascript: void(0);' onClick='sampleClicked(sliderPos+2);'><img id='sample3' src='images/sample3.png'/></a>
	<a href='javascript: void(0);' onClick='sampleClicked(sliderPos+3);'><img id='sample4' src='images/sample4.png'/></a>
	<img src='images/arrowR.png' onClick='slide(+1);'/>
</div>
<script>
var sliderPos=1;
var sliderMax=10;
function slide(v) {
	if(v>0) {
		if(sliderPos>=(sliderMax-3)) return;
		sliderPos++;
	} else {
		if(sliderPos<=1) return;
		sliderPos--;
	}
	for(i=1; i<5; i++) {
		document.getElementById('sample'+i).src="images/sample"+(sliderPos+i-1)+".png";
	}
}
function sampleClicked(v) {
	alert(v);
}
</script>

<!-- Team -->
<div class='main2'>
	<div class='col-12 col-m-12' style='display: block;'>
		<img src='images/team0.png'><br/>
		Name Surname<br/>Marketing manager
	</div>
	<div class='col-3 col-m-12'>
		<img src='images/team1.png'><br/>
		Name Surname<br/>Graphic designer
	</div>
	<div class='col-3 col-m-12'>
		<img src='images/team2.png'><br/>
		Name Surname<br/>Customer manager
	</div>
	<div class='col-3 col-m-12'>
		<img src='images/team3.png'><br/>
		Name Surname<br/>PHP expert
	</div>
	<div class='col-3 col-m-12'>
		<img src='images/team4.png'><br/>
		Name Surname<br/>PHP expert
	</div>
</div>

<!-- Get in touch -->
<div class='main3'>
<h2>GET IN TOUCH</h2>
<div class='col-12'>
bla bla bla...<br/><br/><br/>
</div>

<div class='col-4 col-m-12' style='padding: 0px; margin: 0px;'>
<input class='intouch' type='text' placeholder='Name' id='inTouchName'><br/>
<input class='intouch' type='text' placeholder='e-mail address' id='inTouchMail'><br/>
<input class='intouch' type='text' placeholder='Phone number' id='inTouchPhone'>
</div>

<div class='col-8 col-m-12' style='padding: 0px; margin: 0px;'>
<textarea class='intouch' style='height: 146px;' placeholder='Message' id='inTouchMessage'></textarea>
</div>

<div class='col-12'>
<input type='submit' class='inTouchSubmit' value='SEND MESSAGE'>
</div>
<div style="clear: both;"></div>
</div>

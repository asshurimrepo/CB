<html>
<head>
	<meta charset="UTF-8">
	<title>Seriously Testing</title>
</head>

<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="http://hello.p5js.org/js/vendor/seriously.js"></script>
    <script src="http://hello.p5js.org/js/vendor/effects/seriously.chroma.js"></script>
    <script>
      $(document).ready(function() {

      //   $("#video").bind("loadeddata", function(){

      //     var seriously,
      //       chroma,
      //       target;

      //     seriously = new Seriously();

      //     target = seriously.target('#canvas');
      //     chroma = seriously.effect('chroma');

      //     chroma.source = "#video";
      //     target.source = chroma;
      //     chroma.screen = [0,0,0,1];
      // /*    chroma['clipBlack'] = 1;
      //     chroma['weight'] = 2;*/
      //     seriously.go();

      //     $("input[type=range]").bind("input",function(e) {
      //       update(this);
      //     });

      //     function update(elment) {
      //       var id = $(elment).attr('id')
      //       var value = $(elment).val();

      //       $("#"+id+"Value").html(value);

      //       if ($.inArray(id, ['red','green','blue']) > - 1) {
      //         var red = parseFloat($("#red").val());
      //         var green = parseFloat($("#green").val());
      //         var blue = parseFloat($("#blue").val());
      //         id = "screen";
      //         value = [red,green,blue,1];
      //         chroma.screen = value;
      //       }

      //       chroma[id] = value;
      //     }

      //   });



      $('img').mousemove(function(e) {

          if(!this.canvas) {
              this.canvas = $('<canvas/>').css({width:this.width + 'px', height: this.height + 'px'})[0];
              this.canvas.getContext('2d').drawImage(this, 0, 0, this.width, this.height);
          }
           var offX  = (e.offsetX || e.clientX - $(e.target).offset().left);
           var offY  = (e.offsetY || e.clientY - $(e.target).offset().top);

          var pixelData = this.canvas.getContext('2d').getImageData(offX, offY, 1, 1).data;

          $('#output').html('R: ' + pixelData[0] + '<br>G: ' + pixelData[1] + '<br>B: ' + pixelData[2] + '<br>A: ' + pixelData[3]);


      });





      });
    </script>

  <style>

    </style>
<body>

  <img src="/test1.png" style="height: 400px;">
  <pre id="output"></pre>
<!--

<video id="video"  controls preload>
<source src="/todd.mp4" type="video/mp4" />
</video>
<canvas id="canvas" width="1280" height="720"></canvas>
<div id="controls">
        <label>weight: <span id="weightValue">1</span></label><br/>
        <input type="range" id="weight" min="0" max="2" step="0.01" value="2"/><br/>
        <label>clipWhite: <span id="clipWhiteValue">1</span></label><br/>
        <input type="range" id="clipWhite" min="0" max="1" step="0.01" value="1"/><br/>
        <label>clipBlack: <span id="clipBlackValue">0</span></label><br/>
        <input type="range" id="clipBlack" min="0" max="1" step="0.01" value="1"/><br/>
        <label>balance: <span id="balanceValue">1</span></label><br/>
        <input type="range" id="balance" min="0" max="1" step="0.01" value="1"/><br/>
        <label>red: <span id="redValue"></span>0</label><br/>
        <input type="range" id="red" min="0" max="1" step="0.01" value="0"/><br/>
        <label>green: <span id="greenValue">1</span></label><br/>
        <input type="range" id="green" min="0" max="1" step="0.01" value="1"/><br/>
        <label>blue: <span id="blueValue">0</span></label><br/>
        <input type="range" id="blue" min="0" max="1" step="0.01" value="0"/><br/>
      </div> -->





</body>
</html>
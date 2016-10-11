import Vue from "vue";

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#premade-app",

	ready(){
		console.log('Ready Premade!');
		// this.$http.get('/premade/data').then(response => this.premades = response.data);
    this.premades = window.premades;
	},

	data: {
		premades: [],
		active_project: null
	},

	methods: {

		renderPremade(){
			this.video = videojs('premade-player', { "controls": "true", "preload": "auto" });

            this.video.on("loadedmetadata",() => {

                // rigz script
                $("video#premade-player_html5_api").attr("height", this.vPlayer.videoHeight);
                $("video#premade-player_html5_api").attr("width", this.vPlayer.videoWidth);

                $("#premade-player").prepend($("canvas#output-premade"));
                $("canvas#output-premade").get(0).setAttribute("width", this.vPlayer.videoWidth);
                $("canvas#output-premade").get(0).setAttribute("height", this.vPlayer.videoHeight);

                $("#premade-player").prepend($("canvas#output-premade"));

				// for testing
				$("canvas#output-premade").css('width', '400px');
				// $("#premade-player").css('width', '400px');

                var seriously,
                    target;

                  seriously = new Seriously();

                  target = seriously.target('#output-premade');
                  this.chroma = seriously.effect('chroma');

                  this.chroma.source = "#premade-player_html5_api";
                  target.source = this.chroma;

                  this.chroma['clipWhite'] = 1;
                  this.chroma['clipBlack'] = 0.8;
                  this.chroma['balance'] = 1;
                  this.chroma['weight'] = 1;
                  seriously.go();
            });
            this.vPlayer = document.getElementById("premade-player_html5_api");
            this.video.play();
            this.video.show();
		},

		showPreview(premade){

			// Dispose Video
            if(this.video){
                this.video.dispose();
            }


            let video_template = `
              <div id="video-premade-container">
                <canvas id="output-premade"></canvas>
                <a href="#" class="close-premade text-default"><i class="fa fa-times"></i></a>
                    <video id="premade-player" class="video-js" preload="auto" data-setup='{"poster":"/premades/${premade.filename}.png"}' width="300">
                        <source src="/premades/${premade.filename}" type="video/mp4">

                        <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
              </div>
            `;

            $("#premade-section").empty().html(video_template);
            this.renderPremade();

    		// close button
			$("body").on("click","a.close-premade", (e) => {
				e.preventDefault();
				this.video.pause();
				$("#premade-section").empty();
			});
		},

		addProject(filename){
			swal({
				 title: "Add to Project?",
				 text: "Press OK to confirm",
				 type: "info",
				 showCancelButton: true,
				 closeOnConfirm: false,
				 showLoaderOnConfirm: true,
				},
				() => {
					this.$http.post('/premade/add-to-project', { filename }).then(
						response => {
							  swal("Good job!", "You added new video to your project!", "success")
						}
					);
			});
		}

	}


});
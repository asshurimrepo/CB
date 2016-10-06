// var seeThru = require('seethru');
var  jQueryCaster = require('jquery');
var  videoCasterJS = require('video.js');


export default {
	template: require('../templates/project-player.html'),

	ready(){

	},

	props: ['project'],

	data() {
		return {
			/*Player*/
			animation_request: null,
			vPlayer: null,
			buffer: null,
			output: null,
			dy: 0,
			first_frame: true,
			timer: null,
			is_visible: false,
			video: null,
			seeThru: null,
			vidtime: 0,
			vidduration: 0,
			player_styles: {
				offsets: {
					marginTop: 0,
					marginLeft: 0,
					marginBottom: 0,
					marginRight: 0
				}
			},
			embed_class: {
				position: ""
			},
			player_class: {
				position: "",
				dimmed: false,
				glass: false
			},

			textoverlay_class: {
				valignment: "",
				alignment: ""
			},

			clicktocall_class: {
				valignment: "",
				alignment: ""
			},

			buttonoverlay_class:{
				valignment: "",
				alignment: ""
			},
			textoverlaystart: 0,
			textoverlayduration: 0,
			clicktocallstart: 0,
			clicktocallduration: 0,
			buttonoverlaystart: 0,
			buttonoverlayduration: 0,
			formoverlaystart: 0,
			formoverlayduration: 0

		}
	},


	events: {
		show_preview() {
			setTimeout(() => {
				this.updatePlayer();
				this.playProject();
			}, 200);
		}
	},

	computed: {

		has_Video(){
			let embed = this.project.options.external_video.embed_code;

			if(embed === ""){
				return false;
			}

			return true;
		},
		//textoverlay
		has_Textoverlay(){
			let line1 = this.project.actions.textoverlay_line_1;
			let line2 = this.project.actions.textoverlay_line_2;

			if( line1 === "" && line2 === ""){
				return false;
			}
				return true;
		},

		has_Line1(){
			let line1 = this.project.actions.textoverlay_line_1;
			if( line1 == ""){
				return false
			}
			return true;
		},

		has_Line2(){
			let line2 = this.project.actions.textoverlay_line_2;
			if( line2 == ""){
				return false
			}
			return true;
		},
		// clicktocall
		has_Phonenumber(){
			let phone_number = this.project.actions.clicktocall;

			if(phone_number == ""){
				return false;
			}

			return true;
		},
		//button overlay
		has_Buttonoverlay(){
			let button_overlay = this.project.actions.buttonoverlay_label;

			if(button_overlay == ""){
				return false;
			}

			return true;
		},

		has_Autoresponder(){
			let autoresponder = this.project.actions.autoresponder_name;

			if(autoresponder == ""){
				return false;
			}

			return true;
		},

		formoverlay_titlesize() {
    		if(this.project.actions.formoverlay_titlesize === 'Small') return '14px';
    		if(this.project.actions.formoverlay_titlesize === 'Medium') return '18px';
    		if(this.project.actions.formoverlay_titlesize === 'Large') return '22px';

    		return '18px';
    	},

    	formoverlay_fieldsize(){
    		if(this.project.actions.formoverlay_fieldsize === 'Small') return 'input-sm';
    		if(this.project.actions.formoverlay_fieldsize === 'Medium') return '';
    		if(this.project.actions.formoverlay_fieldsize === 'Large') return 'input-lg';

    		return '';
    	},

    	formoverlay_buttonsize(){
    		if(this.project.actions.formoverlay_buttonsize === 'Small') return 'btn-sm';
    		if(this.project.actions.formoverlay_buttonsize === 'Medium') return '';
    		if(this.project.actions.formoverlay_buttonsize === 'Large') return 'btn-lg';

    		return 'btn-sm';
    	}
	},

	methods: {
		renderTransparentVideo() {
			this.video = videojs('project-player', { "controls": "true", "preload": "auto" });
			// this.video.height(this.project.height*2);
			//@embed$("video#project-player_html5_api").attr("crossorigin", "anonymous");
			// $("video#project-player_html5_api>source").attr("crossorigin", "anonymous");
			this.video.ready(() => {
				this.video.on("loadedmetadata",() => {
					// rigz script
					// this.video.height(this.vPlayer.videoHeight);
					$("video#project-player_html5_api").attr("height", this.vPlayer.videoHeight);
					$("video#project-player_html5_api").attr("width", this.vPlayer.videoWidth);

					$("#project-player").prepend($("canvas#output"));
					$("canvas#output").get(0).setAttribute("width", this.vPlayer.videoWidth);
					$("canvas#output").get(0).setAttribute("height", this.vPlayer.videoHeight);

					// for testing
					$("canvas#output").css('width', '400px');
					$("#project-player").css('width', '400px');
					// for testing
					$("div.loader-3>i").hide();
					this.addActionsToVideo();
					// rigz script


			          var seriously,
			            chroma,
			            target;

			          seriously = new Seriously();

			          target = seriously.target('#output');
			          chroma = seriously.effect('chroma');

			          chroma.source = "#project-player_html5_api";
			          target.source = chroma;

			          chroma['balance'] = this.project.options.video_settings.balance;
			          chroma['clipWhite'] = this.project.options.video_settings.clip_white;
			          chroma['clipBlack'] = this.project.options.video_settings.clip_black;
			          chroma['weight'] = this.project.options.video_settings.weight;
			          seriously.go();

			          	$("div#project-player").css('height','auto');
						this.video.play();
						
				});
				this.videoEnded();
			});




			this.projectOptions();
			this.projectActions();

			this.vPlayer = document.getElementById("project-player_html5_api");


		},




		updatePlayer(){
			this.resetOffsets();

			if(this.project.options.position == 'centered') {
				this.player_class.position = "Project--centered";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
				this.embed_class.position = "Embed--centered";
			}

			if(this.project.options.position == 'top-left') {
				this.player_class.position = "Project--topleft";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
				this.embed_class.position = "Embed--topleft";
			}

			if(this.project.options.position == 'top-right') {
				this.player_class.position = "Project--topright"
				this.player_styles.offsets.marginRight = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
				this.embed_class.position = "Embed--topright";
			}

			if(this.project.options.position == 'bottom-left') {
				this.player_class.position = "Project--bottomleft";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginBottom = this.project.options.offset_y + 'px';
				this.embed_class.position = "Embed--bottomleft";
			}

			if(this.project.options.position == 'bottom-right') {
				this.player_class.position = "Project--bottomright";
				this.player_styles.offsets.marginRight = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginBottom = this.project.options.offset_y + 'px';
				this.embed_class.position = "Embed--bottomright";
			}

			if(this.project.options.dimmed_background == true) {
				this.player_class.dimmed = "Project--dimmedbg";
			}else if(this.project.options.dimmed_background == false){
				this.player_class.dimmed = "";
			}

			if(this.project.options.glass_background == true) {
				this.player_class.glass = "Project--glassbg";
			}else if(this.project.options.glass_background == false){
				this.player_class.glass = "";
			}
		},

		resetOffsets() {
			this.player_styles.offsets.marginTop = 0;
			this.player_styles.offsets.marginLeft = 0;
			this.player_styles.offsets.marginBottom = 0;
			this.player_styles.offsets.marginRight = 0;
		},

		playProject() {

			// Dispose Video
			if(this.video){
				this.video.dispose();
				$("div.loader-3>i.fa-cog").show();
				$(".project-element").hide();
			}

			let delay = parseInt(this.project.options.auto_display_after)*1000;
			let video_template = `
			  <div class="loader-3">
			      <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
			      <span class="sr-only">Loading...</span>
			  </div>
			<a href="#" class="close-project text-danger"><i class="fa fa-times"></i></a>
			<video id="project-player" class="video-js" preload="auto" 
				   data-setup='{"poster":"/image/${this.project.filename}.png"}'
			>
				  <source src="/video/${this.project.filename}" type="video/mp4">
		          <p class="vjs-no-js">
		            To view this video please enable JavaScript, and consider upgrading to a web browser that
		            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
		          </p>

		   	</video>

			<canvas id="output" crossorigin></canvas>
		   	`;


		   	$("#video-section").empty().html(video_template);



			setTimeout(() => {
				this.is_visible = true;
				setTimeout(() => this.renderTransparentVideo(), 300);
				$('#project-player-bg').fadeIn("fast");
			}, delay);

			// close on click background
			$("body").on("click","div#project-player-bg", (e) => {
				if($(e.target).is('div#project-player-bg')){
					this.video.pause();

					$('#project-player-bg').fadeOut("fast");
				}
				e.preventDefault();
		        return;
			});

			// close button
			$("body").on("click","a.close-project", (e) => {
				e.preventDefault();
				this.video.pause();
				$('#project-player-bg').fadeOut("fast");
			});

			//close form
			$("body").on("click","a.close-form", (e) => {
				e.preventDefault();
				$('#project-formoverlay').fadeOut("fast");
				$('#subscriber-username').val('');
				$('#subscriber-email').val('');
				return false;
			});

			//close video embed
			$("body").on("click","div#project-embed-video>a.close-embed", (e) => {
				e.preventDefault();
				let project_embed = $("div#project-embed-video").find('iframe');
				let embed_source = $(project_embed).attr("src");
				if(embed_source == undefined){
					$(project_embed).attr("src", embed_source);
				}
				$('div#project-player-container>div#project-embed-video').fadeOut("fast");
				return false;
			});

		},

		projectOptions(){
			// if close on exit is true
			this.video.on("ended", () =>{
				if(this.project.options.stop_showing.exit_on_end === true){
					$('#project-player-bg').fadeOut("fast");

				}
			});

			// if close on click is true
			if(this.project.options.stop_showing.clicked === true){
				$("#project-player-container").on("click",(e) => {
					if($(e.target).is('canvas#output')){
						this.video.pause();

						$('#project-player-bg').fadeOut("fast");
					}
					e.preventDefault();
			        return;
				});
			}
		},

		projectActions(){
			let url_length = this.project.actions.link_url.length;
			let url = this.project.actions.link_url;

			// textoverlay start and duration
			this.textoverlaystart = parseInt(this.project.actions.textoverlay_start);
			this.textoverlayduration = parseInt(this.project.actions.textoverlay_duration)*1000;

			//clicktocall start and duration
			this.clicktocallstart = parseInt(this.project.actions.clicktocall_start);
			this.clicktocallduration = parseInt(this.project.actions.clicktocall_duration)*1000;

			// buttonoverlay
			this.buttonoverlaystart = parseInt(this.project.actions.buttonoverlay_start);
			this.buttonoverlayduration = parseInt(this.project.actions.buttonoverlay_duration)*1000;

			// formoverlay
			this.formoverlaystart = parseInt(this.project.actions.formoverlay_start);
			this.formoverlayduration = parseInt(this.project.actions.formoverlay_duration)*1000;



			//link url
			if(url_length > 0){
				$("#project-player-container").one("click",(e) => {
					if($(e.target).is('canvas#output')){
						window.open (url, '_blank');
			        }
			        e.preventDefault();
			        return;
				});
			}

			//textoverlay valignment
			if(this.project.actions.textoverlay_valignment == 'middle'){
				this.textoverlay_class.valignment = "Textoverlay--middle";
			}

			if (this.project.actions.textoverlay_valignment == 'top'){
				this.textoverlay_class.valignment = "Textoverlay--top";
			}

			if(this.project.actions.textoverlay_valignment == 'bottom'){
				this.textoverlay_class.valignment = "Textoverlay--bottom";
			}

			//textoverlay alignment
			if(this.project.actions.textoverlay_alignment == 'left'){
				this.textoverlay_class.alignment = "Textoverlay--left";
			}

			if (this.project.actions.textoverlay_alignment == 'center'){
				this.textoverlay_class.alignment = "Textoverlay--center";
			}

			if(this.project.actions.textoverlay_alignment == 'right'){
				this.textoverlay_class.alignment = "Textoverlay--right";
			}

			// clicktocall alignment
			if(this.project.actions.clicktocall_valignment == 'middle'){
				this.clicktocall_class.valignment = "Clicktocall--middle";
			}

			if (this.project.actions.clicktocall_valignment == 'top'){
				this.clicktocall_class.valignment = "Clicktocall--top";
			}

			if(this.project.actions.clicktocall_valignment == 'bottom'){
				this.clicktocall_class.valignment = "Clicktocall--bottom";
			}

			//clicktocall alignment
			if(this.project.actions.clicktocall_alignment == 'left'){
				this.clicktocall_class.alignment = "Clicktocall--left";
			}

			if (this.project.actions.clicktocall_alignment == 'center'){
				this.clicktocall_class.alignment = "Clicktocall--center";
			}

			if(this.project.actions.clicktocall_alignment == 'right'){
				this.clicktocall_class.alignment = "Clicktocall--right";
			}

			// button overlay alignment
			if(this.project.actions.buttonoverlay_valignment == 'middle'){
				this.buttonoverlay_class.valignment = "Buttonoverlay--middle";
			}

			if (this.project.actions.buttonoverlay_valignment == 'top'){
				this.buttonoverlay_class.valignment = "Buttonoverlay--top";
			}

			if(this.project.actions.buttonoverlay_valignment == 'bottom'){
				this.buttonoverlay_class.valignment = "Buttonoverlay--bottom";
			}

			// button overlay alignment
			if(this.project.actions.buttonoverlay_alignment == 'left'){
				this.buttonoverlay_class.alignment = "Buttonoverlay--left";
			}

			if (this.project.actions.buttonoverlay_alignment == 'center'){
				this.buttonoverlay_class.alignment = "Buttonoverlay--center";
			}

			if(this.project.actions.buttonoverlay_alignment == 'right'){
				this.buttonoverlay_class.alignment = "Buttonoverlay--right";
			}

		}, //end of projectActions

		addActionsToVideo() {
			this.video.on("timeupdate",() => {
				this.videoElements();
				this.vidtime = Math.floor(this.video.currentTime());
				this.vidduration = Math.floor(this.video.duration());
			});
		},

		videoElements(){
			//textoverlay show & duration
			// if the start time is greater than the total duration the textoverlay will display at the end

			if(this.textoverlaystart > this.vidduration && this.vidduration != 0){

				if(this.vidtime === this.vidduration){
					$("#project-text-overlay").fadeIn("fast",() =>{
						if(this.textoverlayduration > 0){
							setTimeout(() => {
								$("#project-text-overlay").fadeOut("fast");
							},this.textoverlayduration);
							return false;
						}
					});
				}

				// if duration is set to 0
				if(this.textoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-text-overlay").fadeOut("fast");
						return false;
					});
				}

			}else{


				if(this.vidtime === this.textoverlaystart){
					$("#project-text-overlay").fadeIn("fast",() =>{
						if(this.textoverlayduration > 0){
							setTimeout(() => {
								$("#project-text-overlay").fadeOut("fast");
							},this.textoverlayduration);
							return false;
						}
					});
				}

				// if duration is set to 0
				if(this.textoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-text-overlay").fadeOut("fast");
						return false;
					});
				}

			}

			//clicktocall show & duration
			// if the start time is greater than the total duration the clicktocall will display at the end
			if(this.clicktocallstart > this.vidduration  && this.vidduration != 0){

				if(this.vidtime === this.vidduration){
					$("#project-clicktocall").fadeIn("fast",() =>{
						if(this.clicktocallduration > 0){
							setTimeout(() => {
								$("#project-clicktocall").fadeOut("fast");
							},this.clicktocallduration);
							return false;
						}
					});
				}

				// if duration is set to 0
				if(this.clicktocallduration === 0){
					this.video.on("ended",() => {
						$("#project-clicktocall").fadeOut("fast");
						return false;
					});
				}

			}else{

				if(this.vidtime === this.clicktocallstart){
					$("#project-clicktocall").fadeIn("fast",() =>{
						if(this.clicktocallduration > 0){
							setTimeout(() => {
								$("#project-clicktocall").fadeOut("fast");
							},this.clicktocallduration);
							return false;
						}
					});
				}

				// if duration is set to 0
				if(this.clicktocallduration === 0){
					this.video.on("ended",() => {
						$("#project-clicktocall").fadeOut("fast");
						return false;
					});
				}

			}

			//buttonoverlay show & duration
			// if the start time is greater than the total duration the buttonoverlay will display at the end
			if(this.buttonoverlaystart > this.vidduration  && this.vidduration != 0){

				if(this.vidtime === this.vidduration){
					$("#project-buttonoverlay").fadeIn("fast",() =>{
						if(this.buttonoverlayduration > 0){
							setTimeout(() => {
								$("#project-buttonoverlay").fadeOut("fast");
							},this.buttonoverlayduration);
							return false;
						}
					});

				}

				// if duration is set to 0
				if(this.buttonoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-buttonoverlay").fadeOut("fast");
						return false;
					});
				}

			}else{

				if(this.vidtime === this.buttonoverlaystart){
					$("#project-buttonoverlay").fadeIn("fast",() =>{
						if(this.buttonoverlayduration > 0){
							setTimeout(() => {
								$("#project-buttonoverlay").fadeOut("fast");
							},this.buttonoverlayduration);
							return false;
						}
					});
				}

				// if duration is set to 0
				if(this.buttonoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-buttonoverlay").fadeOut("fast");
						return false;
					});
				}

			}

			//formoverlay show & duration
			// if the start time is greater than the total duration the formoverlay will display at the end

			if(this.formoverlaystart > this.vidduration  && this.vidduration != 0){

				if(this.vidtime === this.vidduration){
				this.project.actions.autoresponder_username = '';
				this.project.actions.autoresponder_email = '';
					$("#project-formoverlay").fadeIn("fast",() =>{
						if(this.formoverlayduration > 0){
							setTimeout(() => {
								$("#project-formoverlay").fadeOut("fast");
							},this.formoverlayduration);
							return false;
						}
					});
				}


				// if duration is set to 0
				if(this.formoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-formoverlay").fadeOut("fast");						
						return false;
					});
				}

			}else{

				if(this.vidtime === this.formoverlaystart){
				this.project.actions.autoresponder_username = '';
				this.project.actions.autoresponder_email = '';
					$("#project-formoverlay").fadeIn("fast",() =>{
						if(this.formoverlayduration > 0){
							setTimeout(() => {
								$("#project-formoverlay").fadeOut("fast");
							},this.formoverlayduration);
							return false;
						}
					});

				}


				// if duration is set to 0
				if(this.formoverlayduration === 0){
					this.video.on("ended",() => {
						$("#project-formoverlay").fadeOut("fast");
						return false;
					});
				}

			}
			//end of elements

		},

		videoEnded(){
			this.video.on("ended", () => {
				if(this.project.options.external_video.embed_code != ""){
					let embed_duration = parseInt(this.project.options.external_video.duration)*1000;
					$("div#project-embed-video").fadeIn("fast");
					if (embed_duration > 0){
						setTimeout(() => {
							let project_embed = $("div#project-embed-video").find('iframe');
							let embed_source = $(project_embed).attr("src");
							if(embed_source == undefined){
								$(project_embed).attr("src", embed_source);
							}
							$("div#project-embed-video").fadeOut("fast");
						},embed_duration);
					}
				}
			});
		},

		subscribe(){
			let autoresponder_type = (this.project.actions.autoresponder).toLowerCase();

			let key = this.$get('project.actions.autoresponder_data.'+autoresponder_type+'.key');			
			let list_name = this.$get('project.actions.autoresponder_data.'+autoresponder_type+'.list');
			let email = this.$get('project.actions.autoresponder_email');
			let user_name = this.$get('project.actions.autoresponder_username');

			if(email == ""){
				return;
			}

			var data = {
					email: email,
					username: user_name,
					list: list_name,
					key: key
				};

			if(autoresponder_type == 'aweber'){

				let aweber_data = this.$get('project.actions.autoresponder_data.'+autoresponder_type);

				$.extend(data,aweber_data);
			}	

			this.$http.post('/autoresponder/' + this.project.actions.autoresponder + '/subscribe', data).then(
                response => {
                	if(response.data == 1){
                		$('#project-formoverlay').fadeOut("fast");
						this.project.actions.autoresponder_username = '';
						this.project.actions.autoresponder_email = '';
                	}
                }
            ).catch(() => {
            	$('#project-formoverlay').fadeOut("fast");
				this.project.actions.autoresponder_username = '';
				this.project.actions.autoresponder_email = '';          	
            });
		}
	}
}

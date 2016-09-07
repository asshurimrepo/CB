// var seeThru = require('seethru');

export default {
	template: require('../templates/project-player.html'),

	ready(){

	},

	props: ['project'],

	data() {
		return {
			/*Player*/
			vPlayer: null,
			buffer: null,
			output: null,
			w: 400,
			h: 0,
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

			this.video = $("video#project-player");

			this.video.on("loadedmetadata",() => {
				this.video.attr("height", this.vPlayer.videoHeight);
				this.h = this.video.attr("height")/2;
			   	this.buffer = $("canvas#buffer").get(0).getContext('2d');
				this.output = $("canvas#output").get(0).getContext('2d');
				// $("#project-player").prepend($("canvas#output"));
				$("canvas#buffer").get(0).setAttribute("height", this.h*2);
				$("canvas#output").get(0).setAttribute("width", this.w);
				$("canvas#output").get(0).setAttribute("height", this.h);
				// this.video.play();
				this.addActionsToVideo();
				this.startProcessing();
				console.log('video height:', this.h);
				console.log('buffer height:', $("canvas#buffer").height());
				console.log('output height:', $("canvas#output").height());
			});

			this.videoEnded();

			this.projectOptions();
			this.projectActions();

			this.vPlayer = document.getElementById("project-player");
		},

		// green screen processing ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		processFrame() {
			this.buffer.drawImage(this.vPlayer, 0, 0);

			var	image=this.buffer.getImageData(0, 0, this.w, this.h-this.dy-0);
			var alpha=this.buffer.getImageData(0, this.h-this.dy, this.w, this.h-this.dy-0);
			var	imageData=image.data;
			var	alphaData=alpha.data;
			if(this.frstfrm) {
				if(navigator.userAgent.toLowerCase().indexOf('firefox')<0) {
					if(alphaData[this.w*4]<50) this.dy=Math.round(6-(400-w)/50)+1;
				}
		      this.frstfrm=false;
			} else {
				var strt=this.w*0+3;
				var len=imageData.length;
				for(var i=strt; i<len; i+=4) imageData[i]=alphaData[i-1];

				this.output.putImageData(image, 0, 0, 0, this.dy, this.w, this.h-this.dy);
		    }
		},

		startProcessing() {
			this.timer = setInterval(() => { this.processFrame(); }, 100);
		},

		stopProcessing() {
			clearInterval(this.timer);
		},

		// green screen processing ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


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
			}

			if(this.project.options.glass_background == true) {
				this.player_class.glass = "Project--glassbg";
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
				// this.video.dispose();
				this.video.remove();
				$(".project-element").hide();
			}

			let delay = parseInt(this.project.options.auto_display_after)*1000;
			let video_template = `
			<a href="#" class="close-project text-default"><i class="fa fa-times"></i></a>
			<video id="project-player" autoplay controls preload="auto" width="400" poster="/image/${this.project.filename}">

		          <source src="/dogtraining.mp4" type="video/mp4">

		   	</video>


		    <canvas width="400" id="buffer"></canvas>
			<canvas id="output"></canvas>
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
					this.vPlayer.pause();
					$('#project-player-bg').fadeOut("fast");
				}
				e.preventDefault();
		        return;
			});

			// close button
			$("body").on("click","a.close-project", (e) => {
				e.preventDefault();
				this.vPlayer.pause();
				$('#project-player-bg').fadeOut("fast");
			});

			//close form
			$("body").on("click","a.close-form", (e) => {
				e.preventDefault();
				$('#project-formoverlay').fadeOut("fast");
				return false;
			});

			//close video embed
			$("body").on("click","div#project-embed>a.close-embed", (e) => {
				e.preventDefault();
				let project_embed = $("div#project-embed").find('iframe');
				let embed_source = $(project_embed).attr("src");
				if(embed_source != undefined){
					$(project_embed).attr("src", embed_source);
				}
				$('div#project-player-container>div#project-embed').fadeOut("fast");
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
						this.video.pause;
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
				this.vidtime = Math.floor(this.vPlayer.currentTime);
				this.vidduration = Math.floor(this.vPlayer.duration);
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
				this.stopProcessing();
				if(this.project.options.external_video.embed_code != ""){
					let embed_duration = parseInt(this.project.options.external_video.duration)*1000;
					$("div#project-embed").fadeIn("fast");
					if (embed_duration > 0){
						setTimeout(() => {
							let project_embed = $("div#project-embed").find('iframe');
							let embed_source = $(project_embed).attr("src");
							if(embed_source != undefined){
								$(project_embed).attr("src", embed_source);
							}
							$("div#project-embed").fadeOut("fast");
						},embed_duration);
					}
				}
			});
		}


	}
}


export default {
	template: require('../templates/project-player.html'),

	ready(){
		this.video = videojs('project-player');
	},

	props: ['project'],

	data() {
		return {
			is_visible: false,
			video: null,
			player_styles: {
				offsets: {
					marginTop: 0,
					marginLeft: 0,
					marginBottom: 0,
					marginRight: 0
				}
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

			video_duration: 0
		}
	},


	events: {
		show_preview() {
			setTimeout(() => {
				this.updatePlayer();
				this.playProject();
				this.projectOptions();
				this.projectActions();
			}, 200);
		}
	},

	computed: {
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
		}
	},

	methods: {
		updatePlayer(){
			this.resetOffsets();

			if(this.project.options.position == 'centered') {
				this.player_class.position = "Project--centered";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
			}

			if(this.project.options.position == 'top-left') {
				this.player_class.position = "Project--topleft";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
			}

			if(this.project.options.position == 'top-right') {
				this.player_class.position = "Project--topright"
				this.player_styles.offsets.marginRight = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginTop = this.project.options.offset_y + 'px';
			};

			if(this.project.options.position == 'bottom-left') {
				this.player_class.position = "Project--bottomleft";
				this.player_styles.offsets.marginLeft = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginBottom = this.project.options.offset_y + 'px';
			}

			if(this.project.options.position == 'bottom-right') {
				this.player_class.position = "Project--bottomright";
				this.player_styles.offsets.marginRight = this.project.options.offset_x + 'px';
				this.player_styles.offsets.marginBottom = this.project.options.offset_y + 'px';
			};

			if(this.project.options.dimmed_background == true) {
				this.player_class.dimmed = "Project--dimmedbg";
			};

			if(this.project.options.glass_background == true) {
				this.player_class.glass = "Project--glassbg";
			};
		},

		resetOffsets() {
			this.player_styles.offsets.marginTop = 0;
			this.player_styles.offsets.marginLeft = 0;
			this.player_styles.offsets.marginBottom = 0;
			this.player_styles.offsets.marginRight = 0;
		},

		playProject() {
			let delay = parseInt(this.project.options.auto_display_after)*1000;
			this.video_duration = 0;

			setTimeout(() => {
				this.is_visible = true;
				$('#project-player-bg').fadeIn("fast");
				this.video.play();
				this.video_duration = Math.floor(this.video.duration())*1000;
			}, delay);

			// close button function
			$("body").on("click","a.close-project", (e) => {
				e.preventDefault();
				this.video.pause();
				$('#project-player-bg').fadeOut("fast");
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
					if($(e.target).is('video#project-player_html5_api')){
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

			//link url
			if(url_length > 0){
				$("#project-player-container").one("click",(e) => {
					if($(e.target).is('video#project-player_html5_api')){
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
		} //end of projectActions

	}
}
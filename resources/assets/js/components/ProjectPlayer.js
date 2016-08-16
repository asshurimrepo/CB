
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
			}
		}
	},

	watch: {
		project() {
			this.updatePlayer();
			this.projectOptions();
			this.projectActions();
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

			setTimeout(() => {
				this.is_visible = true;
				$("#project-player-bg").show();
				this.video.play();
			}, delay);

			// close button function
			$("body").on("click","a.close-project", () => {
				this.video.pause();
				$('#project-player-bg').hide();
			});

		},

		projectOptions(){
			let exit =  this.project.options.stop_showing.exit_on_end;
			let closed_click = this.project.options.stop_showing.clicked;

			// if close on exit is true
			this.video.on("ended", () =>{
				if(exit){
					$('#project-player-bg').hide();
				}
			});

			// if close on click is true
			if(closed_click){
				$("#project-player-container").on("click",() => {
					$("#project-player-bg").hide();
				});
			}

		},

		projectActions(){
			let url_length = this.project.actions.link_url.length;
			let url = this.project.actions.link_url;

			//link url
			if(url_length > 0){
				$("#project-player-container").wrap("<a href='"+ url +"' target='_blank'></a>");
			}
		}

	}
}
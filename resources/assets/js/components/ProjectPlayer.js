
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

			clicktocall_class: {
				valignment: "",
				alignment: ""
			},

			buttonoverlay_class:{
				valignment: "",
				alignment: ""
			}
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
				$('#project-player-bg').fadeIn("fast");
				this.video.play();
			}, delay);
			// close on click background
			$("body").on("click","div#project-player-bg", (e) => {
				e.preventDefault();
				this.video.pause();
				$('#project-player-bg').fadeOut("fast");
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

		} //end of projectActions

	}
}
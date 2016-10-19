import Vue from "vue";
import ProjectPlayer from './components/ProjectPlayer.js';

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#premade-app",

	ready(){
		console.log('Ready Premade!');
    	this.premades = window.premades;
	},

	data: {
		premades: [],
		active_project: null
	},

  components: { ProjectPlayer },

	methods: {

    showPreview(premade) {
       this.active_project = premade;
       this.$broadcast('show_preview');
    },

		addProject(premade){
			swal({
				 title: "Add to Project?",
				 text: "Press OK to confirm",
				 type: "info",
				 showCancelButton: true,
				 closeOnConfirm: false,
				 showLoaderOnConfirm: true,
				},
				() => {
					this.$http.post('/premade/add-to-project', premade).then(
						response => {
							swal({
								title: "Good job!",
								text: "You added new video to your project!",
								type: "success"
							},() => {
								window.location.href = "/home";
							});
						}
					);
			});
		}

	}


});
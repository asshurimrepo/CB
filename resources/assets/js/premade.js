import Vue from "vue";

import ProjectPlayer from './components/ProjectPlayer.js';

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#premade-app",

	ready(){
		console.log('Ready Premade!');
		this.$http.get('/premade/data').then(response => this.premades = response.data);
	},

	data: {
		premades: [],
		active_project: null
	},

	components: {
		ProjectPlayer
	},

	methods: {

		showPreview(premade){
			this.active_project = premade;
			this.$broadcast('show_preview');
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
import Vue from 'vue';

import Project from './components/Project.js';
import ProjectOptions from './components/Options.js';
import ProjectActions from './components/Actions.js';
import ProjectPlayer from './components/ProjectPlayer.js';

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({

	el: "#caster-app",

	ready() {
		console.log('Ready to KickAss!!');

        $('.colorpicker-default').colorpicker();

		this.loadProjects();
		this.getAWeberAuthorizationURL();
<<<<<<< HEAD
		//seeThru.create('video', {start : 'autoplay' , end : 'stop'});

=======

		// seeThru.create('video', {start : 'autoplay' , end : 'stop'});
>>>>>>> 22270dcb885a9c795216b1a1caedf4f9819942e0
	},

	data: {
		projects: [],
		active_project: {
			options: {
				stop_showing: {},
				external_video: {}
			},

			actions: {}
		}
	},

	components: {
		Project, ProjectOptions, ProjectActions, ProjectPlayer
	},

	methods: {
		loadProjects() {
			this.$http.get('/project').then(response => {
				this.projects = response.data;
			});
		},
		getAWeberAuthorizationURL(){
			this.$http.get('/autoresponder/aweber/authorize').then(
				response => this.$broadcast('aweber_authorization_url', response.data)
			);
		}
	}

});
import Vue from 'vue';

import Project from './components/Project.js';
import ProjectOptions from './components/Options.js';
import ProjectActions from './components/Actions.js';
import ProjectEmbed from './components/Embed.js';
import ProjectPlayer from './components/ProjectPlayer.js';
import * as CasterCookies from "js-cookie";

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({

	el: "#caster-app",

	ready() {
		console.log('Ready to KickAss!!');

        $('.colorpicker-default').colorpicker();

		this.loadProjects();
		this.getAWeberAuthorizationURL();
	},

	data: {
		projects: [],
		active_project: {
			options: {
				stop_showing: {},
				external_video: {},
				iframe_settings: {},
				video_settings: {}
			},

			actions: {}
		},
		isTimeout: false
	},

	components: {
		Project, ProjectOptions, ProjectActions, ProjectEmbed, ProjectPlayer
	},

	computed: {
  		has_projects(){
  			return this.projects.length > 0;
  		}
	},

	methods: {
		loadProjects() {
			this.$http.get('/project').then(response => {
				$('.loader-2').fadeOut("slow");
				this.projects = response.data;
			}).catch(() => this.isTimeout = true);
		},
		
		getAWeberAuthorizationURL(){
			this.$http.get('/autoresponder/aweber/authorize').then(
				response => this.$broadcast('aweber_authorization_url', response.data)
			);
		}
	}

});
import Vue from 'vue';

import Project from './components/Project.js';
import ProjectOptions from './components/Options.js';
import ProjectActions from './components/Actions.js';

var seeThru = require('seethru');

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({

	el: "#caster-app",

	ready() {
		console.log('Ready to KickAss!!');

        $('.colorpicker-default').colorpicker();

		this.loadProjects();
		this.getAWeberAuthorizationURL();
		seeThru.create('video', {start : 'autoplay' , end : 'stop'});
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
		Project, ProjectOptions, ProjectActions
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
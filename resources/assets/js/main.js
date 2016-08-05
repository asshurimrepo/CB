import Vue from 'vue';

import Project from './components/Project.js';
import ProjectOptions from './components/Options.js';
import ProjectActions from './components/Actions.js';

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({

	el: "#caster-app",

	ready() {
		console.log('Ready to KickAss!!');

        $('.colorpicker-default').colorpicker();

		this.loadProjects();
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
		}
	}

});
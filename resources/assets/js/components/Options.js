import Properties from '../components/OptionsProperties.js';

export default {
	template: require('../templates/options.html'),

	props: ['project'],

	data() {
		return {
			is_saving: false
		}
	},

	components: {
		Properties
	},

	watch: {
		project() {
			this.$data = this.project;
		}
	},

	data(){
		return {}
	},

	methods: {
		save() {
			this.$http.put('/project/' + this.project.id, this.project);
		}
	}
}
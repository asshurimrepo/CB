import Properties from '../components/OptionsProperties.js';

export default {
	template: require('../templates/options.html'),

	props: ['project'],

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
	}
}
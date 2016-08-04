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

	methods: {
		save() {
			this.is_saving = true;
			
			this.$http.put('/project/' + this.project.id, this.project).then(() => {
				swal("Good job!", "You have successfully save your project settings!", "success");
				this.is_saving = false;
			});
		}
	}
}
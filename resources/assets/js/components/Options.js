export default {
	template: require('../templates/options.html'),

	props: ['project'],

	watch: {
		project() {
			this.$data = this.project;
		}
	},

	data(){
		return {}
	}
}
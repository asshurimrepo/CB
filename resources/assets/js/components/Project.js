export default {

	template: require('../templates/project.html'),

	props: ['data'],

	ready(){
		console.log('Project Component is Ready!');
		this.$data = this.data;
	},

	methods: {
		showOptions() {
			console.log('Showing Options for ' + this.title);
			this.setActive();

			$("#project-options").modal('show');
		},

		setActive() {
			this.$parent.active_project = this.data;
		},

		deleteMe() {
			this.$http.delete('/project/' + this.id)
					  .then(() => this.$parent.loadProjects());
		}
	}

}
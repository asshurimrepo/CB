import Tooltip from '../components/ToolTip';
export default {

	template: require('../templates/project.html'),

	props: ['data'],

	ready(){
		console.log('Project Component is Ready!');

		this.$data = this.data;
	},

	components:{
		Tooltip
	},

	filters: {
	    truncate: function(string, limit) {
	    	if(string == undefined)
			{
				return string;
			}

			return string.length > limit ? string.substr(0, limit) + '...' : string;
	    }
  	},
	methods: {
		showOptions() {
			console.log('Showing Options for ' + this.title);
			this.setActive();

			$("#project-options").modal('show');
		},

		showActions() {
			console.log('Showing Actions for ' + this.title);
			this.setActive();

			$("#project-actions").modal('show');
		},

		showEmbed() {
			console.log('Showing Embed for ' + this.title);
			this.setActive();

			$("#project-embed").modal('show');
		},

		setActive() {
			this.$parent.active_project = this.data;
			setTimeout(() => $('.colorpicker-default').colorpicker('update'), 300);
		},

		showPreview() {
			this.setActive();
			this.$parent.$broadcast('show_preview');
		},

		deleteMe() {
			swal({ title: "Are you sure?",
			   text: "You will not be able to recover this Project file!",
			   type: "warning",
			   showCancelButton: true,
			   confirmButtonColor: "#DD6B55",
			   confirmButtonText: "Yes, delete it!",
			   cancelButtonText: "No, cancel please!",
			   closeOnConfirm: false,
			   closeOnCancel: false },
			   (isConfirm) => {
			   		if (isConfirm) {
				  		swal("Deleted!", "Your Project file has been deleted.", "success");

			   			this.$http.delete('/project/' + this.id)
				  			.then(() => this.$parent.loadProjects());
			   		} else {
			   			swal("Cancelled", "Your Project file is safe :)", "error");
			   		}
				});
		}
	}

}

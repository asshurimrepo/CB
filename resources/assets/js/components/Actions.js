import Linkurl from '../components/ActionsLinkURL.js';
import Clicktocall from '../components/ActionsClickToCall.js';
import Fboverlay from '../components/ActionsFBOverlay.js';

export default {
	template: require('../templates/actions.html'),

	props: ['project'],

	data(){
		return {
			is_saving: false
		}
	},

	watch: {
		project() {
			this.$broadcast('project_change');
		}
	},

	components: {
		Linkurl, Clicktocall, Fboverlay
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
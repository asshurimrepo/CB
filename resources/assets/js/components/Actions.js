import Linkurl from '../components/ActionsLinkURL.js';
import Clicktocall from '../components/ActionsClickToCall.js';
import Fboverlay from '../components/ActionsFBOverlay.js';

export default {
	template: require('../templates/actions.html'),

	props: ['project'],

	components: {
		Linkurl, Clicktocall, Fboverlay
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
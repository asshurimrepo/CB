import Vue from "vue";
import * as CasterCookies from "js-cookie";

Vue.use(require('vue-resource'));

import ProjectPlayer from './components/ProjectPlayer.js';

new Vue({
	el: "#caster-embed-@id",

	ready(){
		console.log('Ready Caster Embed!');

		if(CasterCookies.get('caster@id') === undefined){
			CasterCookies.set('caster@id', true, { expires: this.active_project.options.cookie_life, path: '' });
			this.$broadcast('show_preview');
		}
	},

	components: {
		ProjectPlayer
	},

	data: {
		active_project: {} // Will be replace by object in the backend... 
	}

});
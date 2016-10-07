import Vue from "vue";
import * as CasterCookies from "js-cookie";

Vue.use(require('vue-resource'));

import ProjectPlayer from './components/ProjectPlayer.js';

new Vue({
	el: "#caster-embed-@id",

	ready(){
		console.log('Ready Caster Embed!');

		/*Get Caster ID Cookie if not exists Show Player and set the cookie to its specified time else do nothing*/
		var cookie_time = parseInt(this.active_project.options.cookie_life)*(1/1440);
		console.log(cookie_time);
		if(CasterCookies.get('caster@id') === undefined){
			CasterCookies.set('caster@id', true, { expires: cookie_time, path: '' });

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
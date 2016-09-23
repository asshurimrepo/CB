import Vue from "vue";
Vue.use(require('vue-resource'));

import ProjectPlayer from './components/ProjectPlayer.js';


new Vue({
	el: "#caster-embed-@id",

	ready(){
		console.log('Ready Caster Embed!');
		this.$broadcast('show_preview');
	},

	components: {
		ProjectPlayer
	},

	data: {
		active_project: {} // Will be replace by object in the backend... 
	}

});
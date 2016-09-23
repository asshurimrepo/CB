import Vue from "vue";

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#caster-embed",

	ready(){
		console.log('Ready Caster Embed!');
	}

	








});
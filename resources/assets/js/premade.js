import Vue from "vue";

Vue.use(require('vue-resource'));

new Vue({
	el: "#premade-app",

	ready(){
		console.log('Ready Premade!');
	}
});
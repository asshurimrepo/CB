import Vue from "vue";

Vue.use(require('vue-resource'));

new Vue({
	el: "#premade-app",

	ready(){
		console.log('Ready Premade!');
		this.$http.get('/premade/data').then(response => this.premades = response.data);
	},

	data: {
		premades: []
	}
});
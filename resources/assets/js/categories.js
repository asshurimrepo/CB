import Vue from "vue";

Vue.use(require('vue-resource'));

new Vue({
	el: "#categories-app",

	data: {
		categories: [],
		active: {}
	},

	ready() {
		console.log("Categories are ready!");

		this.$http.get('/admin/categories').then(response => this.categories = response.data);
	},

	methods: {
		setActive(category) {
			this.active = category;
		},

		edit(category) {
			this.setActive(category);
		},

		delete(category) {
			this.setActive(category);
		}
	}
});
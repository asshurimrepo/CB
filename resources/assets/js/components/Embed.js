
export default {
	template: require('../templates/embed.html'),

	props: ['project'],

	data() {
		return {
			hash_id: Math.floor(Math.random() * 10000)
		}
	},

	watch: {
		project() {
			this.hash_id = Math.floor(Math.random() * 10000);
		}
	}
}
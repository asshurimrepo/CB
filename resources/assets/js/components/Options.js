export default {
	template: require('../templates/options.html'),

	props: ['data'],

	ready(){
		this.$data = this.data;
	}
}
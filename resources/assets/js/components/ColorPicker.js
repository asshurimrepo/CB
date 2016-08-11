export default {

	template: require('../templates/color-picker.html'),

	ready() {
		$(this.$el).on('changeColor', this.updateColor);
		$(this.$el).on('hide', this.updateColor);
	},

	props: {
		format: {default: 'rgb'},
		color: {default: null}
	},

	methods: {
		updateColor($color) {
			if($color.target.dataset.colorFormat == 'rgba') {
				return this.$set('color', $color.color.toStringRGBA());
			}
			this.$set('color', $color.color.toStringRGB());
		}
	}

}
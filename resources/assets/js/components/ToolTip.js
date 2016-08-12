export default {
	template: `<span class="tooltips help-tip" 
					data-toggle="tooltip"  
					@mouseover="show"
					:data-original-title="title" :data-placement="placement" data-trigger="hover" data-delay="500">
					<i class="fa fa-question-circle"></i>
				</span>`,

	props: ['title', 'placement'],

	ready() {
		this.jq = jQuery;
	},

	data() {
		return {
			jq: null
		}
	},

	methods: {
		show() {
			this.jq(this.$el).tooltip('show');
		}
	}
}
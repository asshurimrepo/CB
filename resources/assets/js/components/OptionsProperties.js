import Tooltip from '../components/ToolTip';
export default {
	template: require('../templates/options-properties.html'),

	ready() {
       $(".options-ref").change(this.updateSwitchable);
    },

	props: ['project'],

    components: {
        Tooltip
    },

    watch: {
        project() {
            $(".options-ref").change();
        }
    },

    methods: {
        updateSwitchable($this) {
            this.$set('project.options.' + $this.target.id, $this.target.checked);
        }
    }

}
import ColorPicker from '../components/ColorPicker.js';
import Tooltip from '../components/ToolTip';
export default {
	template: require('../templates/actions-clicktocall.html'),

	ready() {
       $(".actions-ref").change(this.updateSwitchable);
    },

    components: {
        ColorPicker, Tooltip
    },

	props: ['project'],

    watch: {
        project() {
            $(".actions-ref").change();
        }
    },

    methods: {
        updateSwitchable($this) {
            this.$set('project.actions.' + $this.target.id, $this.target.checked);
        }
    }

}
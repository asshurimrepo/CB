import ColorPicker from '../components/ColorPicker.js';
import Tooltip from '../components/ToolTip';
export default {
	template: require('../templates/actions-clicktocall.html'),

	ready() {
       $(".actions-ref").change(this.updateSwitchable);
       $("#clicktocall_start").click(this.updateStart);
       $("#clicktocall_duration").click(this.updateDuration);
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
        },
        updateStart($this) {
            let starttime = $($this.currentTarget).parent().find('input').val();
            this.$set('project.actions.'+ $this.currentTarget.id, starttime);
        },
        updateDuration($this) {
            let durationtime = $($this.currentTarget).parent().find('input').val();
            this.$set('project.actions.'+ $this.currentTarget.id, durationtime);
        }
    }

}
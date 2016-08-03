export default {
	template: require('../templates/actions-fboverlay.html'),

	ready() {
       $(".actions-ref").change(this.updateSwitchable);
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
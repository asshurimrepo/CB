export default {
	template: require('../templates/actions-linkurl.html'),

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
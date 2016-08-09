import ColorPicker from '../components/ColorPicker.js';

export default {
	template: require('../templates/actions-fboverlay.html'),

	ready() {
       $(".actions-ref").change(this.updateSwitchable);
       $(".fontsize-buttons").click(this.updateFont);
    },

    components: {
        ColorPicker
    },

	props: ['project'],

    watch: {
        project() {
            $(".actions-ref").change();
        }
    },

    computed: {
    	formoverlay_titlesize() {
    		if(this.project.actions.formoverlay_titlesize === 'Small') return '14px';
    		if(this.project.actions.formoverlay_titlesize === 'Medium') return '18px';
    		if(this.project.actions.formoverlay_titlesize === 'Large') return '22px';

    		return '18px';
    	},
    	formoverlay_fieldsize(){
    		if(this.project.actions.formoverlay_fieldsize === 'Small') return 'input-sm';
    		if(this.project.actions.formoverlay_fieldsize === 'Medium') return '';
    		if(this.project.actions.formoverlay_fieldsize === 'Large') return 'input-lg';

    		return '';
    	},
    	formoverlay_buttonsize(){
    		if(this.project.actions.formoverlay_buttonsize === 'Small') return 'btn-sm';
    		if(this.project.actions.formoverlay_buttonsize === 'Medium') return '';
    		if(this.project.actions.formoverlay_buttonsize === 'Large') return 'btn-lg';

    		return 'btn-sm';
    	}
    },

    methods: {
        updateSwitchable($this) {
            this.$set('project.actions.' + $this.target.id, $this.target.checked);
        },

        isBelongsTo(ref){
            return this.project.actions.autoresponder == ref;
        },

        updateFont($this) {

            // let fontsize = $($this.target).parents(".fontsize-buttons").siblings().val();
            let fontsize = $($this.currentTarget).parent().find('input').val();
            this.$set('project.actions.'+ $this.currentTarget.id, fontsize);
        }
    }

}
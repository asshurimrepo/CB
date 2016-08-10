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

    data() {
        return {
            mailchimp: {
                lists: []
            },
            getresponse: {
                lists: []
            },
            aweber: {
                lists: [],
                authorization_url: null
            },
            isLoading: false
        }
    },

    watch: {
        project() {
            $(".actions-ref").change();
        }
    },

    events: {
        project_change() {
            this.processAutoResponder();
        },

        aweber_authorization_url(url) {
            this.aweber.authorization_url = url;
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
    	},
        mailchimp_list_count(){
            let keys = Object.keys(this.mailchimp.lists);
            return keys.length;
        },
        getresponse_list_count(){
            let keys = Object.keys(this.getresponse.lists);
            return keys.length;
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
            let fontsize = $($this.currentTarget).parent().find('input').val();
            this.$set('project.actions.'+ $this.currentTarget.id, fontsize);
        },

        processAutoResponder() {
            this.isLoading = true;
            let data = this.$get('project.actions.autoresponder_data.' + this.project.actions.autoresponder);

            this.$http.post('/autoresponder/' + this.project.actions.autoresponder, data).then(
                response => {
                    this.$set(this.project.actions.autoresponder + '.lists', response.data);
                    this.isLoading = false;
                }
            ).catch(() => this.isLoading = false);
        }

    }

}
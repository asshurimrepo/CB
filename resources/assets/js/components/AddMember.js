export default {
	template: require('../templates/add-member.html'),

	data() {
		return {
			member: {
				name: null,
				email: null,
				password: null
			},

			is_saving: false
		}
	},

	methods: {
		save() {
			this.is_saving = true;

			this.$http.post('/admin/members', this.member)
				.then( () => {
					swal('Great!', 'You have just added new Member to the pack!', 'success');
					this.is_saving = false;
					this.$dispatch('newMemberAdded');
					this.member = {name: null, email: null, password: null};
				} )
				.catch( reason => {
					swal('Crap!', 'Something just went wrong! Please Try Again!', 'error');
					this.is_saving = false;
				} );
		}
	}
}
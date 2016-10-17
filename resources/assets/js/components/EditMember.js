export default {
	template: require('../templates/edit-member.html'),

	props: ['member'],

	data() {
		return {
			is_saving: false
		}
	},

	methods: {
		save() {
			this.is_saving = true;

			this.$http.put('/admin/members/' + this.member.id, this.member)
				.then( () => {
					swal('Great!', 'You have just updated this member!', 'success');
					this.is_saving = false;
					this.$dispatch('memberUpdated');
				} )
				.catch( reason => {
					swal('Crap!', 'Something just went wrong! Please Try Again!', 'error');
					this.is_saving = false;
				} );
		}
	}
}
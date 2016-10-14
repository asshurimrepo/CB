export default {
	template: require('../templates/edit-category.html'),

	props: ['category'],

	data() {
		return {
			is_saving: false
		}
	},

	methods: {
		save() {
			this.is_saving = true;

			this.$http.put('/admin/categories/' + this.category.id, this.category)
				.then( () => {
					swal('Great!', 'You have just updated this category!', 'success');
					this.is_saving = false;
					this.$dispatch('categoryUpdated');
				} )
				.catch( reason => {
					swal('Crap!', 'Something just went wrong! Please Try Again!', 'error');
					this.is_saving = false;
				} );
		}
	}
}
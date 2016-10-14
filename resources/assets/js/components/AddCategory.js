export default {
	template: require('../templates/add-category.html'),

	data() {
		return {
			category: {
				name: null,
				file: null
			},

			is_saving: false
		}
	},

	methods: {
		save() {
			this.is_saving = true;

			this.$http.post('/admin/categories', this.category)
				.then( () => {
					swal('Great!', 'You have just added new Category to the pack!', 'success');
					this.is_saving = false;
					this.$dispatch('newCategoryAdded');
				} )
				.catch( reason => {
					swal('Crap!', 'Something just went wrong! Please Try Again!', 'error');
					this.is_saving = false;
				} );
		}
	}
}
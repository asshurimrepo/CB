export default {
	template: require('../templates/edit-category.html'),

	props: ['category'],

	data() {
		return {
			is_saving: false
		}
	},

	methods: {
		onFileChange(e) {
			var files = e.target.files || e.dataTransfer.files;

	        if (!files.length) return;

	        this.createImage(files[0]);
		},

		createImage(file) {
	      var image = new Image();
	      var reader = new FileReader();
	      var vm = this;

	      reader.onload = (e) => {
	        // this.category.featured_img = e.target.result;
	        this.category.featured_img = e.target.result;
	        // console.log(e.target.result);
	      };
	      
	      reader.readAsDataURL(file);
	    },
	    
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
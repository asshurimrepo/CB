import Vue from "vue";
import AddCategory from './components/AddCategory.js'
import EditCategory from './components/EditCategory.js'

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#categories-app",

	data: {
		categories: [],
		active: {}
	},

	components: {
		AddCategory, EditCategory
	},

	ready() {
		console.log("Categories are ready!");

		this.loadData();
	},

	events: {
		newCategoryAdded() {
			this.loadData();
		},

		categoryUpdated() {
			this.loadData();
		}
	},

	methods: {
		setActive(category) {
			this.active = category;
		},

		loadData() {
			this.$http.get('/admin/categories').then(response => this.categories = response.data);
		},

		addNewCategory() {
			$("#category-add-new").modal('show');
			console.log('add new');
		},

		editCategory(category) {
			console.log('edit category');
			this.setActive(category);
			$("#category-edit").modal('show');
		},

		deleteCategory(category) {
			this.setActive(category);

			swal({ title: "Are you sure?",
			   text: "You will not be able to recover from this!",
			   type: "warning",
			   showCancelButton: true,
			   confirmButtonColor: "#DD6B55",
			   confirmButtonText: "Yes, delete it!",
			   cancelButtonText: "No, cancel please!",
			   closeOnConfirm: false,
			   closeOnCancel: false },
			   (isConfirm) => {
			   		if (isConfirm) {
				  		swal("Deleted!", "It has been deleted.", "success");

			   			this.$http.delete('/admin/categories/' + category.id)
				  			.then(() => this.loadData() );
			   		} else {
			   			swal("Cancelled", "Your Project file is safe :)", "error");
			   		}
			});
		}
	}
});
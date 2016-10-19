import Vue from "vue";
import AddMember from './components/AddMember.js'
import EditMember from './components/EditMember.js'

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

new Vue({
	el: "#members-app",

	data: {
		members: [],
		active: {}
	},

	components: {
		AddMember, EditMember
	},

	ready() {
		console.log("Members are ready!");

		this.members = window.users;
		// this.loadData();
	},

	events: {
		newMemberAdded() {
			this.loadData();
		},

		memberUpdated() {
			this.loadData();
		}
	},

	methods: {
		setActive(member) {
			this.active = member;
		},

		loadData() {
			this.$http.get('/admin/members/lists').then(response => this.members = response.data);
		},

		addNewMember() {
			$("#member-add-new").modal('show');
			console.log('add new');
		},

		editMember(member) {
			console.log('edit member');
			this.setActive(member);
			$("#member-edit").modal('show');
		},

		deleteMember(member) {
			this.setActive(member);

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

			   			this.$http.delete('/admin/members/' + member.id)
				  			.then(() => this.loadData() );
			   		} else {
			   			swal("Cancelled", "Your Project file is safe :)", "error");
			   		}
			});
		}
	}
});
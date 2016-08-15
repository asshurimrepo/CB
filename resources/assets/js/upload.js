import Vue from "vue";
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') }
});

new Vue({
	el: "#upload-section",

	ready() {
		console.log('Upload is Ready!');

		let that = this;

		$('#fileupload').fileupload({
        	dataType: 'json',
	        done: that.done,
	        progressall: (e, data) => {
	        	this.in_progress = true;
	        	this.$set('progress', parseInt(data.loaded / data.total * 100, 10));
	        }
	    });

	    $(".btn-upload").click(function(){
	    	$("[name='file']").click();
	    });
	},

	data: {
		in_progress: true,
		progress: 0
	},

	methods: {
		done(e, data) {
			console.log(data);
		}
	}
});
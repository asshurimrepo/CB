import Vue from "vue";

Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') }
});


var randomLoadingMessage = function() {
    var lines = new Array(
        "Locating the required gigapixels to render...",
        "Spinning up the hamster...",
        "Shovelling coal into the server...",
        "Programming the flux capacitor",
        'the architects are still drafting', 
    	'would you prefer chicken, steak, or tofu?',
    	'we love you just the way you are',
    	'checking the gravitational constant in your locale',
    	'go ahead -- hold your breath',
    	"at least you're not on hold",
    	"a few bits tried to escape, but we caught them"
    );
    return lines[Math.round(Math.random()*(lines.length-1))];
}

new Vue({
	el: "#upload-section",

	ready() {
		console.log('Upload is Ready!');

		$('#fileupload').fileupload({
        	dataType: 'json',
	        done: this.done,
	        add: (e, data) => {
	        	window.funnie_text = setInterval(() => {
			    	$(".funnies").hide().fadeIn(1000);
			    	this.funnies = randomLoadingMessage();
			    }, 15000);

			    data.submit();
	        },
	        progressall: (e, data) => {
	        	this.in_progress = true;
	        	this.$set('progress', parseInt(data.loaded / data.total * 100, 10));
	        }
	    });

	    $(".btn-upload").click(function(){
	    	$("[name='file']").click();
	    });

	    this.funnies = randomLoadingMessage();

	},

	data: {
		in_progress: false,
		progress: 0,
		funnies: "",
		step: 1
	},

	computed: {
		process_text (){
			if (this.step == 1) return 'Uploading...';
			if (this.step == 2) return 'Processing...';
		}
	},

	methods: {
		done(e, data) {
			clearInterval(window.funnie_text);
			this.process();
		},

		process() {
			this.step = 2;
			this.progress = 10;
		}
	}
});
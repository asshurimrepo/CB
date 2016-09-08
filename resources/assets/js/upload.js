import Vue from "vue";
require("./utilities/randomLoadingMessage");

Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') }
});

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
		process_is_done: false,
		funnies: "",
		step: 1,
		frames: [],
		current_frame: 0
	},

	computed: {
		process_text (){
			if (this.step == 1) return 'Uploading...';
			if (this.step == 2) return 'Processing...';
			if (this.step == 3) return `Converting ${this.current_frame} out of ${this.frames.length} Frames...`;
			if (this.step == 4) return 'Composing your new video...';
			if (this.step == 5) return 'Wrapping up! :)';
		}
	},

	methods: {
		done(e, data) {
			this.process(data.result.id);
		},

		process(id) {
			this.step = 2;
			this.progress = 0;
			this.updateProgress(20, 2000, 4000);

			this.$http.post('/video-processer/' + id).then(() => {
				this.progress = 20;
				setTimeout(() => this.processFrames(id), 500);
			});
		},

		processFrames(id) {
			// this.updateProgress(80, 5000, 10000);
			this.step = 3;

			this.$http.post('/video-processer/'+ id +'/process-frames').then(response => {
				this.frames = response.data;
				this.processSingleFrame(id, 0);
			});
		},

		processSingleFrame(id, current_frame) {
			this.progress = (current_frame/this.frames.length) * 100 - 20;
			this.current_frame = current_frame;

			if(current_frame >= this.frames.length) 
			{
				this.recomposeVideo(id);
				return;
			}

			let image = this.frames[current_frame].split("/");

			this.$http.post('/video-processer/'+ id +'/process-single-frame/' + image[3]).then(response => {
				current_frame += 1;
				this.processSingleFrame(id, current_frame);
			});
		},

		recomposeVideo(id) {
			this.updateProgress(91, 2000, 4000);
			this.step = 4;

			this.$http.post('/video-processer/'+ id +'/recompose-video').then(() => {
				this.progress = 91;
				setTimeout(() => this.finishingUp(id), 500);
			});
		},

		finishingUp(id) {
			this.updateProgress(95, 1000, 4000);
			this.step = 5;

			this.$http.post('/video-processer/'+ id +'/finishing').then(() => {
				this.progress = 100;
				this.process_is_done = true;
			});
		},

		updateProgress(max, min_s, max_s){
			if(this.progress >= max){
				return;
			}

			this.progress += this.getRandomNumber(1,6);

			if(max < this.progress){
				this.progress = max;
			}

			setTimeout(() => this.updateProgress(max, min_s, max_s), this.getRandomNumber(min_s, max_s));
		},

		getRandomNumber(min, max) {
		  	min = Math.ceil(min);
		  	max = Math.floor(max);

		  	console.log(Math.floor(Math.random() * (max - min + 1)) + min);
		  	
		  	return Math.floor(Math.random() * (max - min + 1)) + min;
		}
	}
});
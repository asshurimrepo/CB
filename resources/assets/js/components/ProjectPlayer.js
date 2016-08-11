var seeThru = require('seethru');

export default {
	template: require('../templates/project-player.html'),

	props: ['project'],

	data() {
		return {
			seeThru: null
		}
	},

	events: {
		show_preview() {
			setTimeout(() => {
				$("#project-video-section").empty();

				// Recreate Element on the fly
				$("#project-video-section").html(
					`<video id="project-video" v-if="video_src">
		 					<source src="/video/${this.project.filename}" type="video/mp4">
					</video>`
				);

				seeThru.create('#project-video', {start : 'autoplay' , end : 'stop'});
				$("#project-video-modal").modal('show');
			}, 200);
		}
	}
}
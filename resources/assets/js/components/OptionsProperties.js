import Tooltip from '../components/ToolTip';
export default {
	template: require('../templates/options-properties.html'),

	ready() {
       $(".options-ref").change(this.updateSwitchable);
    },

	props: ['project'],

    data() {
        return {
           vPlayer: null,
           video: null,
           chroma: null
        }
    },

    components: {
        Tooltip
    },

    watch: {
        project() {
            $(".options-ref").change();

            // Dispose Video
            if(this.video){
                this.video.dispose();
            }

            let video_template = `
              <div id="video-preview-container">
                <canvas id="output-preview"></canvas>
                    <video id="preview-player" class="video-js" preload="auto" data-setup='{"poster":"/image/${this.project.filename}"}' width="300">
                        <source src="/video/${this.project.filename}" type="video/mp4">

                        <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
              </div>
            `;

            $("#preview-section").empty().html(video_template);

             this.sliders();
             this.renderPreview();

            $("#project-options").on("hide.bs.modal",() => {
                this.video.pause();
            });
        }
    },

    methods: {
        updateSwitchable($this) {
            this.$set('project.options.' + $this.target.id, $this.target.checked);
        },
        sliders(){
                $("#slider-range-weight").slider({
                    range: "min",
                    value: this.project.options.video_settings.weight*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-weight-amount").text(ui.value);
                        $("#videoWeight").val(ui.value);
                        this.project.options.video_settings.weight = ui.value/100;
                        this.chroma['weight'] = ui.value/100;
                    }
                });
                $("#slider-range-balance").slider({
                    range: "min",
                    value: this.project.options.video_settings.balance*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-balance-amount").text(ui.value);
                        $("#videoBalance").val(ui.value);
                        this.project.options.video_settings.balance = ui.value/100;
                        this.chroma['balance'] = ui.value/100;
                    }
                });
                $("#slider-range-clipblack").slider({
                    range: "min",
                    value: this.project.options.video_settings.clip_black*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-clipblack-amount").text(ui.value);
                        $("#videoClipBlack").val(ui.value);
                        this.project.options.video_settings.clip_black = ui.value/100;
                        this.chroma['clipBlack'] = ui.value/100;
                    }
                });
                $("#slider-range-clipwhite").slider({
                    range: "min",
                    value: this.project.options.video_settings.clip_white*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-clipwhite-amount").text(ui.value);
                        $("#videoClipWhite").val(ui.value);
                        this.project.options.video_settings.clip_white = ui.value/100;
                        this.chroma['clipWhite'] = ui.value/100;
                    }
                });
        },
        renderPreview(){
            this.video = videojs('preview-player', { "controls": "true", "preload": "auto" });
            this.video.hide();

            this.video.on("loadedmetadata",() => {

                // rigz script
                $("video#preview-player_html5_api").attr("height", this.vPlayer.videoHeight);
                $("video#preview-player_html5_api").attr("width", this.vPlayer.videoWidth);

                $("#preview-player").prepend($("canvas#output-preview"));
                $("canvas#output-preview").get(0).setAttribute("width", this.vPlayer.videoWidth);
                $("canvas#output-preview").get(0).setAttribute("height", this.vPlayer.videoHeight);

                $("#preview-player").prepend($("canvas#output-preview"));

                var seriously,
                    target;

                  seriously = new Seriously();

                  target = seriously.target('#output-preview');
                  this.chroma = seriously.effect('chroma');

                  this.chroma.source = "#preview-player_html5_api";
                  target.source = this.chroma;

                  this.chroma['clipWhite'] = this.project.options.video_settings.clip_white;
                  this.chroma['clipBlack'] = this.project.options.video_settings.clip_black;
                  this.chroma['balance'] = this.project.options.video_settings.balance;
                  this.chroma['weight'] = this.project.options.video_settings.weight;
                  seriously.go();

            });

            this.video.on("play", () => this.video.show() );
            $("[href='#videosettings']").click(() => this.video.play() );

            this.vPlayer = document.getElementById("preview-player_html5_api");
        }


    }

}
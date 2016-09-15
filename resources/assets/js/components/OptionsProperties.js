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
           player: null,
           chroma: null
        }
    },

    components: {
        Tooltip
    },

    watch: {
        project() {
            $(".options-ref").change();

          /*  // Dispose Video
            if(this.player){
                this.player.dispose();
                $(".project-element").hide();
            }*/

            if(typeof this.project.options.video_settings.weight == undefined)
            {
                this.$set('project.options.video_settings.weight', 1);
            }

            if(typeof this.project.options.video_settings.balance == undefined)
            {
                this.$set('project.options.video_settings.balance', 1);
            }

            if(typeof this.project.options.video_settings.clipBlack == undefined)
            {
                this.$set('project.options.video_settings.clipBlack', 1);
            }

            if(typeof this.project.options.video_settings.clipWhite == undefined)
            {
                this.$set('project.options.video_settings.clipWhite', 1);
            }

             this.sliders();
             this.renderPreview();
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
                    value: this.project.options.video_settings.clipBlack*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-clipblack-amount").text(ui.value);
                        $("#videoClipBlack").val(ui.value);
                        this.project.options.video_settings.clipBlack = ui.value/100;
                        this.chroma['clipBlack'] = ui.value/100;
                    }
                });
                $("#slider-range-clipwhite").slider({
                    range: "min",
                    value: this.project.options.video_settings.clipWhite*100,
                    min: 0,
                    max: 100,
                    slide: (event, ui) => {
                        $("#slider-range-clipwhite-amount").text(ui.value);
                        $("#videoClipWhite").val(ui.value);
                        this.project.options.video_settings.clipWhite = ui.value/100;
                        this.chroma['clipWhite'] = ui.value/100;
                    }
                });
        },
        renderPreview(){
            this.player = videojs('preview-player', { "controls": "true", "preload": "auto" });

            this.player.ready(() => {
                this.player.on("loadedmetadata",() => {

                    // rigz script
                    $("video#preview-player_html5_api").attr("height", this.vPlayer.videoHeight);
                    $("video#preview-player_html5_api").attr("width", this.vPlayer.videoWidth);

                    $("#preview-player").prepend($("canvas#output-preview"));
                    $("canvas#output-preview").get(0).setAttribute("width", this.vPlayer.videoWidth);
                    $("canvas#output-preview").get(0).setAttribute("height", this.vPlayer.videoHeight);


                    $("#preview-player").prepend($("canvas#output-preview"));
                    // rigz script

                      var seriously,
                        target;

                      seriously = new Seriously();

                      target = seriously.target('#output-preview');
                      this.chroma = seriously.effect('chroma');

                      this.chroma.source = "#preview-player_html5_api";
                      target.source = this.chroma;

                      this.chroma['clipWhite'] = this.project.options.video_settings.clipWhite;
                      this.chroma['clipBlack'] = this.project.options.video_settings.clipBlack;
                      this.chroma['weight'] = this.project.options.video_settings.weight;

                      seriously.go();
                      // this.video.play();


                });
            });
            this.vPlayer = document.getElementById("preview-player_html5_api");
        }


    }

}
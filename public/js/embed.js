/*Scripts*/
var casterJS = document.createElement('script');
casterJS.setAttribute("src", "//caster-buddy.dev/embed/caster.js?ID=@id"); 

var seriouslyJs = document.createElement('script');
seriouslyJs.setAttribute("src", "//caster-buddy.dev/js/seriously.js"); 

var seriouslyChromaJs = document.createElement('script');
seriouslyChromaJs.setAttribute("src", "//caster-buddy.dev/js/seriously.chroma.js"); 

var videoJS = document.createElement('script');
videoJS.setAttribute("src", "//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"); 

/*Styles*/
var playerStyle = document.createElement('link'); 
playerStyle.setAttribute('rel', 'stylesheet');
playerStyle.setAttribute("href", "//caster-buddy.dev/css/project-player.css");

var fontAwesomeStyle = document.createElement('link');
fontAwesomeStyle.setAttribute('rel', 'stylesheet');
fontAwesomeStyle.setAttribute("href", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css");

var videoStyle = document.createElement('link');
videoStyle.setAttribute('rel', 'stylesheet');
videoStyle.setAttribute("href", "//vjs.zencdn.net/5.10.8/video-js.css");

/*Elements*/
var container_div = document.createElement("div");
container_div.setAttribute('id', 'caster-embed-@id');
var component_player = document.createElement("project-player");
component_player.setAttribute(':project', 'active_project');
container_div.appendChild(component_player);

/*Add to DOM*/
document.querySelector('head').appendChild(playerStyle);
document.querySelector('head').appendChild(fontAwesomeStyle);
document.querySelector('head').appendChild(videoStyle);

document.querySelector('body').appendChild(container_div);
document.querySelector('body').appendChild(seriouslyJs);
document.querySelector('body').appendChild(seriouslyChromaJs);
document.querySelector('body').appendChild(videoJS);
document.querySelector('body').appendChild(casterJS);
/*Scripts*/
var casterJS = document.createElement('script');
casterJS.setAttribute("src", "@url/embed/caster.js?ID=@id"); 

/*Styles*/
var playerStyle = document.createElement('link'); 
playerStyle.setAttribute('rel', 'stylesheet');
playerStyle.setAttribute("href", "@url/css/project-player.css");

var fontAwesomeStyle = document.createElement('link');
fontAwesomeStyle.setAttribute('rel', 'stylesheet');
fontAwesomeStyle.setAttribute("href", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css");


/*Elements*/
var container_div = document.createElement("div");
container_div.setAttribute('id', 'caster-embed-@id');
var component_player = document.createElement("project-player");
component_player.setAttribute(':project', 'active_project');
container_div.appendChild(component_player);

/*Add to DOM*/
document.querySelector('head').appendChild(playerStyle);
document.querySelector('head').appendChild(fontAwesomeStyle);

document.querySelector('body').appendChild(container_div);
document.querySelector('body').appendChild(casterJS);
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


/*Add to DOM*/
document.querySelector('head').appendChild(playerStyle);
document.querySelector('head').appendChild(fontAwesomeStyle);
document.querySelector('body').appendChild(casterJS);
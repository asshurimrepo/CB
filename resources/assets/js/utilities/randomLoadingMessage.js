window.randomLoadingMessage = function() {
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
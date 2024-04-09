// Initialising the canvas
$(document).ready(function() {
    var canvas = document.getElementById('rain-canvas');
    var ctx = canvas.getContext('2d');
// Setting the width and height of the canvas
    //canvas.width = window.innerWidth;
    //canvas.height = window.innerHeight;

// Setting up the letters
    var letters = 'ABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZ';
    //var letters = '01';
    letters = letters.split('');

// Setting up the columns
    var fontSize = 10,
        columns = canvas.width / fontSize;

// Setting up the drops
    var drops = [];
    for (var i = 0; i < columns; i++) {
        drops[i] = 1;
    }
    var fontArgs = ctx.font.split(' ');
    var newSize = '20px';
    ctx.font = newSize + ' ' + fontArgs[fontArgs.length - 1]; /// using the last part
// Setting up the draw function
    function draw() {
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < drops.length; i++) {
            var text = letters[Math.floor(Math.random() * letters.length)];
            ctx.fillStyle = 'darkgreen';
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);
            drops[i]++;
            if (drops[i] * fontSize > canvas.height && Math.random() > .95) {
                drops[i] = 0;
            }
        }
    }

// Loop the animation
    setInterval(draw, 33);
})



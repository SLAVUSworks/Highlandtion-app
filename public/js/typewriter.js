var app = document.getElementById('app');

var typewriter = new Typewriter(app, {
    loop: true
});

typewriter.typeString('Highlandtion <u style="text-decoration: red underline;">2.1</u>')
    .pauseFor(2500)
    .deleteAll()
    .typeString('<strong>High</strong>')
    .pauseFor(1000)
    .deleteAll()
    .typeString('<strong>Landbouw</strong>')
    .pauseFor(1000)
    .deleteAll()
    .typeString('<strong>Competition</strong>')
    .pauseFor(1000)
    .start();
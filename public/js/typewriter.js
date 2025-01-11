var app = document.getElementById('app');

var typewriter = new Typewriter(app, {
    loop: true
});

typewriter.typeString('Main Tagline <u style="text-decoration: red underline;">Test Tagline</u>')
    .pauseFor(1500)
    .deleteChars(10)
    .typeString('<strong>Testing.</strong>')
    .pauseFor(2500)
    .deleteAll()
    .typeString('Test Test Test <strong>Test Tes</strong>')
    .pauseFor(2500)
    .start();
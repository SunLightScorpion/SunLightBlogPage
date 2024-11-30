const express = require('express');
const http = require('http');
const path = require('path');

const app = express();

/*

TODO:

Seite soll modern und simple sein (Theme: Dark), es ist ein Download Bereich (Spigot und Software) geplant,
ein Bereich für das Minecraft Netzwerk (online zahlen, registrierte Spieler, Online Status und Updates),
Es soll unten eine Link Ansammlung geben (Github, Discord usw),
Bitte mache auch RECHTS das vorgefertigt IFrame ein, das werde ich via PM schicken.

*/

require('dotenv').config();

const isDevMode = process.env.NODE_ENV === 'development';
const PORT = isDevMode ? 8080 : 80;

app.use(express.static('public'));

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});
app.get('/game', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'game.html'));
});

const server = http.createServer(app);

server.listen(PORT, () => {
    console.log(`Express Server läuft auf Port ${PORT}!`);
});

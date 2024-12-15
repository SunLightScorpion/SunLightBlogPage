const express = require('express');
const http = require('http');
const path = require('path');

const app = express();

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

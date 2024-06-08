const express = require('express');
const http = require('http');
const path = require('path');

const app = express();
const PORT = 80;

app.use(express.static('public'));

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

const server = http.createServer(app);

server.listen(PORT, () => {
    console.log(`Express Server läuft auf Port ${PORT}!`);
});

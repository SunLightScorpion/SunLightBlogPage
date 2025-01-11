const express = require('express');
const http = require('http');
const path = require('path');
const fs = require('fs');
const mime = require('mime-types');

const app = express();

require('dotenv').config();

const isDevMode = process.env.NODE_ENV === 'development';
const PORT = isDevMode ? 8080 : 80;

app.use(express.static('public'));

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});/*
app.get('/game', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'game.html'));
});*/
app.get('/downloads', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'downloads.html'));
});
app.get('/minecraft', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'minecraft_server.html'));
});

const rootDir = path.join(__dirname, 'files');

app.get('/api/sunlightscorpion/*', (req, res) => {
    const requestPath = req.params[0];
    const filePath = path.join(rootDir, decodeURIComponent(requestPath));

    console.log(`Request detected: ${req.method} ${req.url}`);

    fs.stat(filePath, (err, stats) => {
        if (err || !stats.isFile()) {
            res.writeHead(404, { 'Content-Type': 'text/plain' });
            res.end('File not found');
            return;
        }

        let contentType = mime.lookup(filePath) || 'application/octet-stream';

        if (path.extname(filePath) === '.slsd') {
            contentType = 'text/plain';
        }

        console.log(`File found and sent back to target ${filePath} with content-type ${contentType}`);

        res.writeHead(200, {
            'Content-Type': contentType,
            'Content-Length': stats.size
        });

        fs.createReadStream(filePath).pipe(res);
    });
});


const server = http.createServer(app);

server.listen(PORT, () => {
    console.log(`Express Server läuft auf Port ${PORT}!`);
});

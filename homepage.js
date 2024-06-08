const express = require('express');
const path = require("path");

const web = express();
const PORT = 80;

web.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

web.listen(PORT, () => {
    console.log("Server läuft auf Port 80!");
})

<?php
session_start();

@include 'util.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Report erstellen</title>
    <link rel="stylesheet" href="style.css">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<div class="header-image">
    <h1>Ticket Erstellen</h1>
</div>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="downloads.php">Downloads</a></li>
        <li><a href="tickets.php">Ticket Ansicht</a></li>
        <li><a href="ticket_report.php" class="active">Ticket erstellen</a></li>
        <li><a href="https://github.com/SunLightScorpion" target="_blank">Github</a></li>
        <li><a href="https://discord.gg/JuqWbQpMmh" target="_blank">Discord</a></li>
    </ul>
    <div class="button-container">
        <form action="logout.php" method="post">
            <button type="submit">Abmelden</button>
        </form>
    </div>
</nav>

<div class="content">
    <form action="create_ticket.php" method="post">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Beschreibung:</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>
        <button type="submit">Bug melden</button>
    </form>
</div>

</body>
</html>

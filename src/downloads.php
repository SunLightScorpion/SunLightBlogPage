<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Downloads</title>
    <link href="style.css" rel="stylesheet">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<div class="header-image">
    <h1>Downloads</h1>
</div>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="downloads.php">Downloads</a></li>
        <li><a href="tickets.php">Ticket Ansicht</a></li>
        <li><a href="ticket_report.php">Ticket erstellen</a></li>
        <li><a href="https://github.com/SunLightScorpion" target="_blank">Github</a></li>
        <li><a href="https://discord.gg/JuqWbQpMmh" target="_blank">Discord</a></li>
    </ul>
    <?php
    $loggedIn = isset($_SESSION["user"]);

    if ($loggedIn) {
        echo '
    <div class="button-container">
        <form action="logout.php" method="post">
            <button type="submit">Abmelden</button>
        </form>
    </div>
    ';
    } else {
        echo '
    <div class="button-container">
        <form action="login.php" method="post">
            <button type="submit">Anmelden</button>
        </form>
        <form action="register.php" method="post">
            <button type="submit">Registrieren</button>
        </form>
    </div>
    ';
    }
    ?>
</nav>

<div class="content">

    <div class="explanation">
        <h2>Open Source Downloads</h2>
        <p>Diese Downloads werden als Open Source Software zur Verfügung gestellt, das bedeutet, du kannst sie gemäß der
            entsprechenden Lizenzen frei verwenden, anpassen und verbreiten.</p>
        <p>Weitere Informationen und um beizutragen, besuche unser <a href="https://github.com/SunLightScorpion"
                                                                      target="_blank">GitHub-Repository</a>.</p>
        <p>Wenn du Probleme hast oder Vorschläge machen möchtest, melde sie bitte auf unserem <a
                href="https://sunlightdev.org/development/blog/ticket_report.php" target="_blank">Ticket System</a>.</p>
    </div>

    <div class="dashboard-item">
        <h2>Honey Core</h2>
        <p>Plattform: Spigot/PaperSpigot</p>
        <p>Beschreibung: Core System für Spigot/Paper</p>
        <p>Version: 1.20</p>
        <a href="HoneyCore.jar" class="invisible-link"></a>
    </div>

    <div class="dashboard-item">
        <h2>OpenAPI</h2>
        <p>Beschreibung: Öffentliche API von Developer für Developer</p>
        <p>Version: 1.0</p>
        <a href="OpenAPI.jar" class="invisible-link"></a>
    </div>

</div>

<script src="function_download.js"></script>

</body>
</html>

<?php

function database_blogpost(): mysqli {
    $envFile = __DIR__ . '/.env';
    $envVariables = parse_ini_string(file_get_contents($envFile));
    return new mysqli($envVariables["HOST"], $envVariables["NAME"], $envVariables["PASSWORD"], $envVariables["NAME"]);
}

function get_config(){
    $propertiesFile = "config.properties";
    $config = parse_ini_file($propertiesFile);

    if ($config === false) {
        die("Fehler beim Lesen der Properties-Datei: " . error_get_last()['message']);
    }

    return $config;
}

function getBugComments($ticket_id) : void {
    $query = "SELECT * FROM bug_comments WHERE bug_id = '$ticket_id' ORDER BY created_at ASC";
    $result = mysqli_query(database_blogpost(), $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Kommentar: " . $row['comment'] . "<br>";
            echo "Erstellt am: " . $row['created_at'] . "<br>";
            echo "Erstellt von: " . $row['created_from'] . "<br><br>";
        }
    } else {
        echo "Fehler beim Abrufen der Kommentare: " . mysqli_error(database_blogpost());
    }
}

?>

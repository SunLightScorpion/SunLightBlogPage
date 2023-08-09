<?php

function database_blogpost() : mysqli {
    $envFile = __DIR__ . '/.env';
    $envVariables = parse_ini_string(file_get_contents($envFile));
    return new mysqli($envVariables["HOST"], $envVariables["NAME"], $envVariables["PASSWORD"], $envVariables["NAME"]);
}

function println($data) : void {
    print "$data<br>";
}

/*

    $propertiesFile = "dev.properties";
    $config = parse_ini_file($propertiesFile);

    if ($config === false) {
        die("Fehler beim Lesen der Properties-Datei: " . error_get_last()['message']);
    }

*/

?>

<?php

function database_blogpost() : mysqli {
    $envFile = __DIR__ . '/.env';
    $envVariables = parse_ini_string(file_get_contents($envFile));
    return new mysqli($envVariables["HOST"], $envVariables["NAME"], $envVariables["PASSWORD"], $envVariables["NAME"]);
}

function getBugComments($ticket_id) : void {
    $query = "SELECT * FROM bug_comments WHERE bug_id = '$ticket_id' ORDER BY created_at DESC";
    $result = mysqli_query(database_blogpost(), $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Kommentar:<br> " . $row['comment'] . "<br>";
            echo "Erstellt am: " . $row['created_at'] . "<br>";
            echo "Erstellt von: " . $row['created_from'] . "<br><br>";
        }
    } else {
        echo "Fehler beim Abrufen der Kommentare: " . mysqli_error(database_blogpost());
    }
}

function generateUUIDv4() : string {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

function addCommentToBug($bug_id, $author, $comment) : mysqli_result | bool {
    $db = database_blogpost();
    $comment = mysqli_real_escape_string($db, $comment);

    $query = "INSERT INTO bug_comments (bug_id, comment, created_at, created_from) 
              VALUES ('$bug_id', '$comment', NOW(), '$author')";

    return mysqli_query($db, $query);
}


<?php
@include 'util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $reporter_name = $_POST['reporter_name'];

    $query = mysqli_query(database_blogpost(), "INSERT INTO bug_reports (title, description, reporter_name, status, created_at) 
                                                 VALUES ('$title', '$description', '$reporter_name', 'Open', NOW())");

    if ($query) {
        echo "Bug erfolgreich gemeldet!";
    } else {
        echo "Fehler beim Melden des Bugs.";
    }
}
?>

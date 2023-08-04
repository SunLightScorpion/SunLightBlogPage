<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Start</title>
</head>
<body>

<?php

@include 'util.php';

$query = mysqli_query(database_blogpost(), "SELECT * FROM blog_posts ORDER BY created_at DESC");

if ($result = $query) {
    foreach ($query as $post) {
        println("Title: ".$post['title']);
        println("Content: ".$post['content']);
        println("Created at: ".$post['created_at']);
        println("");
        println("");
    }
}

?>

</body>
</html>

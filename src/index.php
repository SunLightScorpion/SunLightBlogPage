<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Start</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
@include 'util.php';

$per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $per_page;

function get_total_blog_posts()
{
    $query = mysqli_query(database_blogpost(), "SELECT COUNT(*) as total FROM blog_posts");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}

$total_pages = ceil(get_total_blog_posts() / $per_page);

$query = mysqli_query(database_blogpost(), "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT $offset, $per_page");

if ($result = $query) {
    foreach ($query as $post) {
        println("Title: " . $post['title']);
        println("Content: " . $post['content']);
        println("Created at: " . $post['created_at']);
        println("");
        println("");
    }

    if ($total_pages > 1) {
        echo "<div class='pagination'>";

        if ($current_page > 1) {
            echo "<a href='index.php?page=" . ($current_page - 1) . "'>vorherige </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo "<span class='current'>$i</span>";
            } else {
                echo "<a href='index.php?page=$i'>$i</a>";
            }
            if ($i < $total_pages) {
                echo ", ";
            }
        }

        if ($current_page < $total_pages) {
            echo "<a href='index.php?page=" . ($current_page + 1) . "'>, nächste</a>";
        }

        echo "</div>";
    }
}
?>

</body>
</html>

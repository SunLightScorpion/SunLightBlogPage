<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Detail</title>
    <link rel="stylesheet" href="style.css">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<header>
    <h1>Bug Detail</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php" class="active">Bug Reports</a></li>
    </ul>
</nav>

<div class="content">
    <?php
    @include 'util.php';

    if (isset($_GET['bug_id'])) {
        $bug_id = $_GET['bug_id'];

        $query = mysqli_query(database_blogpost(), "SELECT * FROM bug_reports WHERE id = $bug_id");

        if ($result = $query) {
            foreach ($query as $bug) {
                echo "<div class='bug-detail'>";
                echo "<h2>Bug #" . $bug['id'] . "</h2>";
                echo "<p><strong>Description:</strong> " . $bug['description'] . "</p>";
                echo "<p><strong>Reporter:</strong> " . $bug['reporter_name'] . "</p>";
                echo "<p><strong>Created at:</strong> " . $bug['created_at'] . "</p>";
                echo "<p><strong>Status:</strong> " . $bug['status'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Bug not found.";
        }
    } else {
        echo "Bug ID not provided.";
    }
    ?>
</div>

</body>
</html>

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

<div class="header-image">
    <h1>Bug Detail</h1>
</div>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php" class="active">Ticket Ansicht</a></li>
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
            echo "Ticket not found.";
        }
    } else {
        echo "Ticket ID not provided.";
    }
    ?>

    <div class="comment-section">
        <h3>Comments</h3>
        <?php
        if (isset($_GET['bug_id'])) {
            $bug_id = $_GET['bug_id'];
            getBugComments($bug_id);
        }
        ?>
    </div>

</div>

<center>
    <form method="post">
        <textarea name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Add Comment">
    </form>
</center>

</body>
</html>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<div class="header-image">
    <h1>Homepage</h1>
</div>

<nav>
    <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="downloads.php">Downloads</a></li>
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
    <?php
    @include 'util.php';

    $per_page = 5;
    $current_page = $_GET['page'] ?? 1;
    $offset = ($current_page - 1) * $per_page;

    function get_total_blog_posts() {
        $query = mysqli_query(database_blogpost(), "SELECT COUNT(*) as total FROM blog_posts");
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    $total_pages = ceil(get_total_blog_posts() / $per_page);

    $query = mysqli_query(database_blogpost(), "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT $offset, $per_page");

    if ($result = $query) {
        foreach ($query as $post) {
            echo "<div class='post'>";
            echo "<h2>" . $post['title'] . "</h2>";
            echo "<p>" . $post['content'] . "</p>";
            echo "<p>Erstellt am: " . $post['created_at'] . "</p>";
            echo "</div>";
        }

        if ($total_pages > 1) {
            echo "<div class='pagination'>";

            if ($current_page > 1) {
                echo "<a href='index.php?page=" . ($current_page - 1) . "'>Prev</a>";
            }

            $start = max(1, $current_page - 2);
            $end = min($start + 4, $total_pages);

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $current_page) {
                    echo "<span class='current'>$i</span>";
                } else {
                    echo "<a href='index.php?page=$i'>$i</a>";
                }
            }

            if ($total_pages > 5 && $current_page < $total_pages - 1) {
                echo "<a href='index.php?page=" . $total_pages . "'>$total_pages</a>";
            }

            if ($current_page < $total_pages) {
                echo "<a href='index.php?page=" . ($current_page + 1) . "'>Next</a>";
            }

            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>

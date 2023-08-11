<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Ansicht</title>
    <link rel="stylesheet" href="style.css">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<div class="header-image">
    <h1>Ticket Ansicht</h1>
</div>

<nav>
    <ul>
        <li><a href="index.php">Hauptseite</a></li>
        <li><a href="tickets.php" class="active">Ticket Ansicht</a></li>
        <li><a href="downloads.html">Downloads</a></li>
        <li><a href="ticket_report.php">Ticket erstellen</a></li>
        <li><a href="https://github.com/SunLightScorpion" target="_blank">Github</a></li>
        <li><a href="https://discord.gg/DRKeawjsq7" target="_blank">Discord</a></li>
    </ul>
</nav>

<div class="content">
    <?php
    @include 'util.php';

    $logged_in_user = "GreenDevBlood";

    $per_page = 25;
    $current_page = $_GET['page'] ?? 1;
    $offset = ($current_page - 1) * $per_page;

    $query = mysqli_query(database_blogpost(), "SELECT * FROM bug_reports WHERE reporter_name = '$logged_in_user' ORDER BY created_at DESC LIMIT $offset, $per_page");

    if ($query) {
        echo "<table>";
        echo "<tr><th>BugID</th><th>Beschreibung</th></tr>";

        foreach ($query as $bug) {
            echo "<tr>";
            echo "<td><a href='ticket_detail.php?bug_id=" . $bug['id'] . "' class='bug-link'>" . $bug['id'] . "</a></td>";
            echo "<td>" . $bug['title'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        $total_bugs = mysqli_query(database_blogpost(), "SELECT COUNT(*) as total FROM bug_reports WHERE reporter_name = '$logged_in_user'");
        $total_bugs = mysqli_fetch_assoc($total_bugs)['total'];
        $total_pages = ceil($total_bugs / $per_page);

        if ($total_pages > 1) {
            echo "<div class='pagination'>";

            if ($current_page > 1) {
                echo "<a href='tickets.php?page=" . ($current_page - 1) . "'>Prev</a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo "<span class='current'>$i</span>";
                } else {
                    echo "<a href='tickets.php?page=$i'>$i</a>";
                }
            }

            if ($current_page < $total_pages) {
                echo "<a href='tickets.php?page=" . ($current_page + 1) . "'>Next</a>";
            }

            echo "</div>";
        }
    } else {
        echo "Fehler beim Abrufen der Daten.";
    }
    ?>
</div>

</body>
</html>

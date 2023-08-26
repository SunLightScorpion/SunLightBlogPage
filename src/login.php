<?php
session_start();

@include 'util.php';

if (database_blogpost()->connect_error) {
    die("Connection failed: " . database_blogpost()->connect_error);
}

if (isset($_POST["submit"])) {
    $user = htmlentities($_POST["username"]);
    $pw = htmlentities($_POST["pw"]);

    $db = database_blogpost();

    $query = "SELECT * FROM customer_accounts WHERE name=?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        echo "Der Benutzer existiert nicht!";
        header("location: login.php");
    } else {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if (password_verify($pw, $stored_password)) {
            $_SESSION["user"] = $user;
            header("Location: index.php");
        } else {
            echo "Falsches Passwort!";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="style.css" rel="stylesheet">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<header>
    <h1>User Login</h1>
</header>

<br>

<center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="pw" placeholder="Passwort" required><br>
        <button type="submit" name="submit">Login</button><br>
    </form>
</center>

</body>
</html>

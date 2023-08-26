<?php
session_start();

@include 'util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $connection = database_blogpost();
    $name_exists_query = "SELECT COUNT(*) as count FROM customer_accounts WHERE name = '$name'";
    $name_result = $connection->query($name_exists_query);
    $name_count = $name_result->fetch_assoc()['count'];

    if ($name_count > 0) {
        $_SESSION['register_error'] = "Name already exists. Please choose a different name.";
        header("Location: register.php");
        exit();
    }

    $email_exists_query = "SELECT COUNT(*) as count FROM customer_accounts WHERE email = '$email'";
    $email_result = $connection->query($email_exists_query);
    $email_count = $email_result->fetch_assoc()['count'];

    if ($email_count > 0) {
        $_SESSION['register_error'] = "Email already exists. Please use a different email address.";
        header("Location: register.php");
        exit();
    }

    $uuid = generateUUIDv4();

    $uuid_exists_query = "SELECT COUNT(*) as count FROM customer_accounts WHERE uuid = '$uuid'";
    $uuid_result = $connection->query($uuid_exists_query);
    $uuid_count = $uuid_result->fetch_assoc()['count'];

    while ($uuid_count > 0) {
        $uuid = generateUUIDv4();
        $uuid_result = $connection->query($uuid_exists_query);
        $uuid_count = $uuid_result->fetch_assoc()['count'];
    }

    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO customer_accounts (uuid, name, email, password) VALUES ('$uuid', '$name', '$email', '$hashed_password')";

    if ($connection->query($insert_query) === TRUE) {
        $_SESSION['register_success'] = "Registration successful. You can now log in.";
        header("Location: login.php");
    } else {
        $_SESSION['register_error'] = "Error creating account: " . $connection->error;
        header("Location: register.php");
    }

    $connection->close();
} else {
    header("Location: register.php");
}

?>

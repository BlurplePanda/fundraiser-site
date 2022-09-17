<?php
include 'session_connection.php';
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='styles.css'>
</head>

<body>
<header>
    <?php include 'header.php' ?>
</header>

<main>
    <?php
    // Destroy the session (including session variables!)
    session_destroy();

    // Message + redirect
    echo "<h1> Logged out! </h1>";
    echo "<p> Redirecting...";
    header("refresh:1, url=login.php")
    ?>
</main>
</body>

</html>
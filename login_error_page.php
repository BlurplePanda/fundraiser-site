<?php include 'session_connection.php';
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
    <h1>Oops!</h1>
    <p>You have to log in to access that page.</p>
    <?php header("refresh:2, url=login.php") ?>
</main>
</body>

</html>
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
    <p>You are already logged in. You have to log out before creating/logging into a different account.</p>
    <?php header("refresh:2, url=index.php") ?>
</main>
</body>

</html>
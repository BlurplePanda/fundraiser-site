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
    <?php include 'header.php'?>
</header>

<main>
    <h1>Oops!</h1>
    <p>That's not your campaign. Make sure you are logged in to the right account.</p>
    <p>Redirecting...</p>
    <?php header("refresh:3, url=user_campaigns.php")?>
</main>
</body>

</html>
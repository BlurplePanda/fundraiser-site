<?php include 'session_connection.php';
if(!isset($_SESSION['user'])){
    header("location:error_page.php");
}
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <?php include 'header.php'?>
</header>

<main>
    <h1>Create a fundraising campaign</h1>
    <form action='insert_campaign.php' method='post' enctype='multipart/form-data'>
        <label for='charity'>Charity:</label>
        <input type='text' id='charity' name='charity'><br>
        <label for='desc'>Campaign description:</label>
        <textarea id='desc' name='desc'></textarea><br>
        <label for='img'>Image:</label>
        <input type='file' id='img' name='img' accept='image/*'><br>
        <label for='goal'>Campaign goal:</label>
        <input type='number' step='0.01' min='0' max='9999999.99' id='goal' name='goal'>
        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form><br>
</main>
</body>

</html>
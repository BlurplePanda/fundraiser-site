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
    <form action='insert_campaign.php' method='post'>
        <label for='charity'>Charity:</label>
        <input type='text' id='charity' name='charity'><br>
        <label for='desc'>Campaign description:</label>
        <textarea id='desc' name='desc'></textarea><br>
        <fieldset>
            <legend>Image:</legend>
            <label for='food'><img src='images/food.png'></label><br>
            <input type='radio' id='food' name='img' value='food.png'>
            <label for='health'><img src='images/Public-health-icon.png'></label><br>
            <input type='radio' id='health' name='img' value='Public-health-icon.png'>
            <label for='education'><img src='images/learn-icon.png'></label><br>
            <input type='radio' id='education' name='img' value='learn-icon.png'>
            <label for='money'><img src='images/money.png'></label><br>
            <input type='radio' id='money' name='img' value='money.png'>
        </fieldset>
        <label for='goal'>Campaign goal:</label>
        <input type='number' step='0.01' min='0' max='9999999.99' id='goal' name='goal'>
        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form><br>
</main>
</body>

</html>
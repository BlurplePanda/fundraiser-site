<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <img src='images/rundfaise-logo.png' alt='Rundfaise logo and text: Donate - Support - Fundraise' class='center'>
    <nav>
        <a href='index.php' class='button' id='current'> Home </a>
        <a href='campaign_list.php' class='button'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <h1>Create a fundraising campaign</h1>
    <form action='insert_campaign.php' method='post'>
        <label for='charity'>Charity:</label>
        <input type='text' id='charity' name='charity'><br>
        <label for='desc'>Campaign description:</label>
        <textarea id='desc' name='desc'></textarea><br>
        <label for='img'>Image:</label>
        <input type='image' id='img' name='img'><br>
        <label for='goal'>Campaign goal:</label>
        <input type='number' step='0.01' min='0' max='9999999.99' id='goal' name='goal'>
        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form><br>
</main>
</body>

</html>
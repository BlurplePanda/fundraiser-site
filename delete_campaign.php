<?php
include 'session_connection.php';

$page = $_GET['id']; // Passed through url
$delete_page = "DELETE FROM pages WHERE PageID='$page'"; // Query to delete selected page

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
    <?php
    // Check if deletion worked, display message accordingly
    if(mysqli_query($con, $delete_page)){
        echo "<h1>Page deleted.</h1>";
        header("refresh:2; url=user_campaigns.php");
    }
    else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again.";
    }

    ?>
</main>
</body>

</html>
<?php
include 'session_connection.php';

$charity = $_POST['charity'];
$desc = $_POST['desc'];
$img = $_POST['img'];
$goal = $_POST['goal'];
$page = $_POST['page'];

$update_page = "UPDATE pages SET ChosenCharity='$charity', PageDesc='$desc',
                PageImage='$img', PageGoal='$goal' WHERE PageID='$page'";
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
    if(mysqli_query($con, $update_page)){
        echo "<h1>Page updated!</h1>";
        header("refresh:2; url=campaign.php?id=".$page."&fromurl=edit_campaign.php?id=".$page);
    }
    else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again.";
    }

    ?>
</main>
</body>

</html>
<?php
include 'session_connection.php';

// Form results
$name = mysqli_real_escape_string($con, $_POST['title']);
$charity = mysqli_real_escape_string($con, $_POST['charity']);
$desc = mysqli_real_escape_string($con, $_POST['desc']);
$img = mysqli_real_escape_string($con, $_POST['img']);
$goal = mysqli_real_escape_string($con, $_POST['goal']);
$fr_id = $_SESSION['user'];

// Query to insert campaign into database
$insert_page = "INSERT INTO pages (PageName, FundraiserID, ChosenCharity, PageDesc, PageImage, PageGoal)
                VALUES ('$name', '$fr_id', '$charity', '$desc', '$img', '$goal')";
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
    // Check if query worked, display message accordingly
    if (mysqli_query($con, $insert_page)) {
        echo "<h1>Page created!</h1>
              <p>Redirecting...</p>";
        $newpageid = mysqli_insert_id($con);
        header("refresh:1; url=campaign.php?id=" . $newpageid . "&fromurl=create_campaign.php");
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again once redirected.";
        header("refresh:2; url=create_campaign.php");
    }

    ?>
</main>
</body>

</html>
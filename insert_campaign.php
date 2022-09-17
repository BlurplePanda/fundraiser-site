<?php
include 'session_connection.php';

// Form results
$name = $_POST['title'];
$charity = $_POST['charity'];
$desc = $_POST['desc'];
$img = $_POST['img'];
$goal = $_POST['goal'];
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
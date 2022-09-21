<?php
include 'session_connection.php';

// Form results
$title = mysqli_real_escape_string($con, $_POST['title']);
$charity = mysqli_real_escape_string($con, $_POST['charity']);
$desc = mysqli_real_escape_string($con, $_POST['desc']);
if (isset($_POST['img'])) {
    // Don't change the image if none was selected (ie if they have an image that they can't reselect)
    $img = mysqli_real_escape_string($con, $_POST['img']);
} else {
    $img = mysqli_real_escape_string($con, $_POST['currimg']);
}
$goal = mysqli_real_escape_string($con, $_POST['goal']);
$page = mysqli_real_escape_string($con, $_POST['page']);

// Query to update the campaign/page in the database
$update_page = "UPDATE pages SET PageName='$title', ChosenCharity='$charity', PageDesc='$desc',
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
    <?php include 'header.php' ?>
</header>

<main>
    <?php
    // Check if query worked, display message (& redirect) accordingly
    if (mysqli_query($con, $update_page)) {
        echo "<h1>Page updated!</h1>
              <p>Redirecting...</p>";
        header("refresh:1; url=campaign.php?id=" . $page . "&fromurl=edit_campaign.php?id=" . $page);
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again once redirected.";
        header("refresh:2; url=edit_campaign.php?id=".$page);
    }

    ?>
</main>
</body>

</html>
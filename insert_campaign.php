<?php
include 'session_connection.php';

$charity = $_POST['charity'];
$desc = $_POST['desc'];
$img = $_POST['img'];
$goal = $_POST['goal'];
$fr_id = $_SESSION['user'];

$insert_page = "INSERT INTO pages (FundraiserID, ChosenCharity, PageDesc, PageImage, PageGoal)
                VALUES ('$fr_id', '$charity', '$desc', '$img', '$goal')";
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
    if(mysqli_query($con, $insert_page)){
        echo "<h1>Page created!</h1>";
        $newpageid = mysqli_insert_id($con);
        header("refresh:2; url=campaign.php?id=".$newpageid."&fromurl=create_campaign.php");
    }

    ?>
</main>
</body>

</html>
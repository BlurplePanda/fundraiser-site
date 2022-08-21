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
        <a href='campaignlist.php' class='button'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <h1>Make a pledge</h1>
    <?php
    if(isset($_POST['campaign'])) {
        $campaign = $_POST['campaign'];
        $which_campaign_query = "SELECT * FROM fundraisers WHERE fundraisers.FundraiserID =".$campaign;
        $which_campaign_result = mysqli_query($con, $which_campaign_query);
        $which_campaign_record = mysqli_fetch_assoc($which_campaign_result);
        echo "<p>You have chosen to make a pledge to: ".$which_campaign_record['FRFName']." ".$which_campaign_record['FRLName']."</p>";

    }
    else {
        echo "<img src='images/error.png' alt='Cartoon of generic error message' class='campaignimage' width='150'>";
        echo "<p class='campaigntext'>You have to choose a campaign!";
    }
    ?>


</main>
</body>

</html>
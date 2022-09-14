<?php include 'session_connection.php'?><!DOCTYPE html>

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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $this_campaign_query = "SELECT pages.*, fundraisers.FRFName, fundraisers.FRLName, IFNULL(SUM(pagepledges.PledgeAmount), 0) as PledgeTotal
                            FROM (SELECT PageID, PledgeAmount FROM pledges WHERE PageID = " . $id . ") as pagepledges, pages, fundraisers
                            WHERE pages.PageID = " . $id . " AND pages.FundraiserID = fundraisers.FundraiserID";
        $this_campaign_result = mysqli_query($con, $this_campaign_query);
        $this_campaign_record = mysqli_fetch_assoc($this_campaign_result);
        echo "<h1>" . $this_campaign_record['PageName'] . "</h1>";
        echo "<div class='campaign-info'>";
        echo "<div class='campaignimage'><img src='images/" . $this_campaign_record['PageImage'] . "' class='singlecampaignimg' alt=''></div>";
        echo "<div class='campaigntext'>";
        echo "<p class='campaigntext'>Fundraiser / campaign organiser: " . $this_campaign_record['FRFName'] . " " . $this_campaign_record['FRLName']; // https://english.stackexchange.com/a/548055
        echo "<p class='campaigntext'>Fundraising for: " . $this_campaign_record['ChosenCharity'];
        echo "<p class='campaigntext'>Description: " . $this_campaign_record['PageDesc'];
        echo "<p class='campaigntext'>Amount raised: $" . $this_campaign_record['PledgeTotal'] . "/$" . $this_campaign_record['PageGoal'];
        echo "<img border='0' src='thermometer.php?Current=" . $this_campaign_record['PledgeTotal'] . "&Goal=" . $this_campaign_record['PageGoal'] . "&Width=300&Height=75&Font=2'>";
        echo "</div></div>";

        $currenturl = $_SERVER['REQUEST_URI'];
        echo "<h2>Pledge to this campaign</h2>
              <form action='insert_pledge.php' method='post'>
              <label for='fname'>First name:</label>
              <input type='text' id='fname' name='fname'><br>
              <label for='lname'>Last name:</label>
              <input type='text' id='lname' name='lname'><br>
              <label for='email'>Email address:</label>
              <input type='email' id='email' name='email'><br>
              <label for='amount'>Pledge amount:</label>
              <input type='number' step='0.01' min='0' max='999999.99' id='amount' name='amount'>
              <input type='hidden' id='page' name='page' value='$id'>
              <input type='hidden' id='url' name='url' value='$currenturl'>
              <!-- Submit button -->
              <input type='submit' value='Submit'>
              </form><br>";

        echo "<p><a href=" . $_GET['fromurl'] . ">Back to previous page</a>";
    } else {
        echo "<img src='images/error.png' alt='Cartoon of generic error message' class='campaignimage' width='150'>";
        echo "<p class='campaigntext'>You have to choose a campaign!";
    }


    ?>


</main>
</body>
</html>

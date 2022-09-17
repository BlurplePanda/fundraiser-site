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
        // Assign id to a variable (if a campaign has been chosen)
        $id = $_GET['id'];

        // Get all info about this specific campaign
        $this_campaign_query = "SELECT pages.*, fundraisers.FRFName, fundraisers.FRLName, IFNULL(SUM(pagepledges.PledgeAmount), 0) as PledgeTotal
                            FROM (SELECT PageID, PledgeAmount FROM pledges WHERE PageID = " . $id . ") as pagepledges, pages, fundraisers
                            WHERE pages.PageID = " . $id . " AND pages.FundraiserID = fundraisers.FundraiserID";
        $this_campaign_result = mysqli_query($con, $this_campaign_query);
        $this_campaign_record = mysqli_fetch_assoc($this_campaign_result);

        // Display campaign info
        echo "<h1>" . $this_campaign_record['PageName'] . "</h1>"; // Title
        echo "<div class='campaign-info'>";
        echo "<div class='campaignimage'><img src='images/" . $this_campaign_record['PageImage']
            . "' class='singlecampaignimg' alt=''></div>"; // Image
        echo "<div class='campaigntext'>";
        echo "<p class='campaigntext'>Fundraiser / campaign organiser: " . $this_campaign_record['FRFName'] . " "
            . $this_campaign_record['FRLName']; // Slash spaces: https://english.stackexchange.com/a/548055
        echo "<p class='campaigntext'>Fundraising for: " . $this_campaign_record['ChosenCharity'];
        echo "<p class='campaigntext'>Description: " . $this_campaign_record['PageDesc'];
        echo "<p class='campaigntext'>Amount raised: $" . $this_campaign_record['PledgeTotal'] . "/$"
            . $this_campaign_record['PageGoal']; // Amount raised out of goal, displayed like $3000/$90000
        echo "<img border='0' src='thermometer.php?Current=" . $this_campaign_record['PledgeTotal'] . "&Goal="
            . $this_campaign_record['PageGoal'] . "&Width=300&Height=75&Font=2'>"; // Thermometer-style progress graph
        echo "</div></div>";

        // Save current url in a variable
        $currenturl = $_SERVER['REQUEST_URI'];

        // "Make a pledge" form
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
              
              <!-- Pass PageID and the current url to the form action page -->
              <input type='hidden' id='page' name='page' value='$id'>
              <input type='hidden' id='url' name='url' value='$currenturl'>
              
              <!-- Submit button -->
              <input type='submit' value='Submit'>
              </form><br>";

        // Link to return to previous url, which was passed in a get variable
        echo "<p><a href=" . $_GET['fromurl'] . ">Back to previous page</a>";

    }

    // If no campaign was chosen (ie the url was simply typed in)
    else {
        echo "<h1>You have to choose a campaign!</h1>
              <p>Redirecting...</p>";
        header("refresh:2; url=campaign_list.php");
    }


    ?>


</main>
</body>
</html>

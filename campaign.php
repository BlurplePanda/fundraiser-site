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
        <a href='index.php' class='button'> Home </a>
        <a href='campaignlist.php' class='button'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <h1> Campaign Information </h1>

    <div class='campaign-info'>
    <?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $this_campaign_query = "SELECT pages.*, fundraisers.FRFName, fundraisers.FRLName, IFNULL(SUM(pagepledges.PledgeAmount), 0) as PledgeTotal
                            FROM (SELECT PageID, PledgeAmount FROM pledges WHERE PageID = ".$id.") as pagepledges, pages, fundraisers
                            WHERE pages.PageID = ".$id." AND pages.FundraiserID = fundraisers.FundraiserID";
        $this_campaign_result = mysqli_query($con, $this_campaign_query);
        $this_campaign_record = mysqli_fetch_assoc($this_campaign_result);
        echo "<div class='campaignimage'><img src='images/".$this_campaign_record['PageImage']."' class='singlecampaignimg' alt=''></div>";
        echo "<div class='campaigntext'><p class='campaigntext'>".$this_campaign_record['FRFName']." ".$this_campaign_record['FRLName']."'s fundraising campaign";
        echo "<p class='campaigntext'>Fundraising for: ".$this_campaign_record['ChosenCharity'];
        echo "<p class='campaigntext'>Description: ".$this_campaign_record['PageDesc'];
        echo "<p class='campaigntext'>Amount raised: $".$this_campaign_record['PledgeTotal']."/$".$this_campaign_record['PageGoal'];
        echo "</div></div>";
        echo "<p><a href='makepledge.php?campaign=".$id."'>Make a pledge</a>";
        echo "<p><a href=".$_GET['fromurl'].">Back to previous page</a>";
    }

    else {
        echo "<img src='images/error.png' alt='Cartoon of generic error message' class='campaignimage' width='150'>";
        echo "<p class='campaigntext'>You have to choose a campaign!";
    }


    ?>


</main>
</body>
</html>

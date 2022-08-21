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
        <a href='campaignlist.php' class='button' id='current'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <h1>Campaigns</h1>
    <h2> Search </h2>
    <div class='search'>
    <!--name/phrase search-->
    <form action='campaignlist.php' method='post'>
        <label for='search'> Search by name </label><br>
        <input type='text' name='search' id='search'>
        <input type='submit' name='submit' value='Search'>
    </form>
    <br>
    <?php
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $search_query = "SELECT pages.PageID, pages.PageGoal, pages.PageImage, fundraisers.FRFName, fundraisers.FRLName
                         FROM pages, fundraisers
                         WHERE pages.FundraiserID = fundraisers.FundraiserID
                         AND (fundraisers.FRFName LIKE '%".$search."%' OR fundraisers.FRLName LIKE '%".$search."%')
                         ORDER BY fundraisers.FRFName";
        $search_result = mysqli_query($con, $search_query);
        $count = mysqli_num_rows($search_result);

        if($count==0) {
            echo "There were no search results!<br>";
        }
        else {
            while($row = mysqli_fetch_array($search_result)) {
                echo "<a href='campaign.php?id=".$row['PageID']."'><img src='images/".$row['PageImage']."' alt='' class='searchcampaignimage'>" .$row ['FRFName']." ".$row['FRLName']."'s fundraiser</a>";
                echo "<br>";
            }
        }
    }
    ?></div>

    <h2> All Campaigns</h2>
    <form name='sort_form' id='sort_form' method='post'>
        <label for='sortby'> Sort by: </label>
        <select id='sortby' name='sortby'>
            <!--options-->
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemName ASC'){echo "selected ";}?>value='itemName ASC'>Name (A-Z)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemName DESC'){echo "selected ";}?>value='itemName DESC'>Name (Z-A)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemPrice ASC'){echo "selected ";}?>value='itemPrice ASC'>Price (low to high)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemPrice DESC'){echo "selected ";}?>value='itemPrice DESC'>Price (high to low)</option>
        </select>

        <input type='submit' value='Click to sort'>
    </form>
    <div class='all-campaigns-container'>
    <?php

    if(isset($_POST['sortby'])){
        $sort_by = $_POST['sortby'];
    }
    else{
        $sort_by = 'FRFName ASC';
    }

    $all_campaigns_query = "SELECT pages.PageID, pages.PageGoal, pages.PageImage, fundraisers.FRFName, fundraisers.FRLName
                            FROM pages, fundraisers
                            WHERE pages.FundraiserID = fundraisers.FundraiserID
                            ORDER BY ".$sort_by;
    $all_campaigns_result = mysqli_query($con, $all_campaigns_query);

    while($all_campaigns_record = mysqli_fetch_assoc($all_campaigns_result)) {
        echo "<div class='campaign'>";
        echo "<p><a href='campaign.php?id=".$all_campaigns_record['PageID']."&fromurl=".$_SERVER['REQUEST_URI']."'><img src='images/".$all_campaigns_record['PageImage']."' alt='' class='allcampaignsimage'><br>".$all_campaigns_record['FRFName']." ".$all_campaigns_record['FRLName']."'s fundraiser<br>";
        echo $all_campaigns_record['PageGoal'];
        echo "</a></div>\n";
    }
    ?></div>


</main>
</body>
</html>

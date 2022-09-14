<?php include 'session_connection.php'?><!DOCTYPE html>

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
    <h1>Campaigns</h1>
    <h2> Search </h2>
    <div class='searches'>

        <div class='search'>
            <!-- Campaign name search -->
            <form action='campaign_list.php' method='post'>
                <label for='csearch'> Search by title </label><br>
                <input type='text' name='csearch' id='csearch'>
                <input type='submit' name='csubmit' value='Search'>
            </form>
            <br>

            <?php
            if(isset($_POST['csearch'])) {
                $c_search = $_POST['csearch'];
                $c_search_query = "SELECT pages.PageID, pages.PageImage, pages.PageName
                             FROM pages
                             WHERE pages.PageName LIKE '%".$c_search."%'
                             ORDER BY pages.PageName";
                $c_search_result = mysqli_query($con, $c_search_query);
                $c_count = mysqli_num_rows($c_search_result);

                if($c_count==0) {
                    echo "There were no search results!<br>";
                }
                else {
                    while($row = mysqli_fetch_array($c_search_result)) {
                        echo "<a href='campaign.php?id=".$row['PageID']."'><img src='images/".$row['PageImage']."' alt='' class='searchcampaignimage'>" .$row ['PageName']."</a>";
                        echo "<br>";
                    }
                }
            }
            ?></div>

        <div class='search'>
        <!-- Fundraiser/organiser name search -->
        <form action='campaign_list.php' method='post'>
            <label for='frsearch'> Search by fundraiser </label><br>
            <input type='text' name='frsearch' id='frsearch'>
            <input type='submit' name='frsubmit' value='Search'>
        </form>
        <br>
        <?php
        if(isset($_POST['frsearch'])) {
            $fr_search = $_POST['frsearch'];
            $fr_search_query = "SELECT pages.PageID, pages.PageName, pages.PageImage, fundraisers.FRFName, fundraisers.FRLName
                             FROM pages, fundraisers
                             WHERE pages.FundraiserID = fundraisers.FundraiserID
                             AND (fundraisers.FRFName LIKE '%".$fr_search."%' OR fundraisers.FRLName LIKE '%".$fr_search."%')
                             ORDER BY fundraisers.FRFName";
            $fr_search_result = mysqli_query($con, $fr_search_query);
            $fr_count = mysqli_num_rows($fr_search_result);

            if($fr_count==0) {
                echo "There were no search results!<br>";
            }
            else {
                while($row = mysqli_fetch_array($fr_search_result)) {
                    echo "<a href='campaign.php?id=".$row['PageID']."'><img src='images/".$row['PageImage']."' alt='' class='searchcampaignimage'>"
                        .$row['PageName']." (".$row ['FRFName']." ".$row['FRLName'].")</a>";
                    echo "<br>";
                }
            }
        }
        ?></div>
    </div>

    <h2> All Campaigns</h2>
    <form name='sort_form' id='sort_form' method='post'>
        <label for='sortby'> Sort by: </label>
        <select id='sortby' name='sortby'>
            <!--options-->
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='PageName ASC'){echo "selected ";}?>value='PageName ASC'>Campaign title (A-Z)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='PageName DESC'){echo "selected ";}?>value='PageName DESC'>Campaign title (Z-A)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='FRFName ASC'){echo "selected ";}?>value='FRFName ASC'>Fundraiser name (A-Z)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='FRFName DESC'){echo "selected ";}?>value='FRFName DESC'>Fundraiser name (Z-A)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='PageGoal ASC'){echo "selected ";}?>value='PageGoal ASC'>Goal size (low to high)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='PageGoal DESC'){echo "selected ";}?>value='PageGoal DESC'>Goal size (high to low)</option>
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

    $all_campaigns_query = "SELECT pages.PageID, pages.PageGoal, pages.PageImage, pages.PageName, fundraisers.FRFName, fundraisers.FRLName
                            FROM pages, fundraisers
                            WHERE pages.FundraiserID = fundraisers.FundraiserID
                            ORDER BY ".$sort_by;
    $all_campaigns_result = mysqli_query($con, $all_campaigns_query);

    while($all_campaigns_record = mysqli_fetch_assoc($all_campaigns_result)) {
        echo "<div class='campaign'>";
        echo "<p><a href='campaign.php?id=".$all_campaigns_record['PageID']."&fromurl=".$_SERVER['REQUEST_URI']."'>
              <img src='images/".$all_campaigns_record['PageImage']."' alt='' class='allcampaignsimage'><br>";
        echo $all_campaigns_record['PageName']."<br>";
        echo $all_campaigns_record['FRFName']." ".$all_campaigns_record['FRLName']."<br>";
        echo $all_campaigns_record['PageGoal'];
        echo "</a></div>\n";
    }
    ?></div>


</main>
</body>
</html>

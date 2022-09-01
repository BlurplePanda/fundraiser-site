<?php include 'session_connection.php';
if(!isset($_SESSION['user'])){
    header("location:error_page.php");
} else{ $user = $_SESSION['user']; }
?><!DOCTYPE html>

<html lang='en'>

    <head>
        <title> My campaigns - Rundfaise </title>
        <meta charset='utf-8'>
        <link rel='stylesheet' type='text/css' href='styles.css'>
    </head>

    <body>
        <header>
            <?php include 'header.php'?>
        </header>

        <main>
            <h1>My campaigns</h1>
            <?php
            $my_campaigns_query = "SELECT pages.PageID, pages.PageGoal, pages.PageImage, fundraisers.FRFName, fundraisers.FRLName
                        FROM pages, fundraisers
                        WHERE pages.FundraiserID = fundraisers.FundraiserID AND fundraisers.FundraiserID = '$user'
                        ORDER BY pages.PageGoal";
            $my_campaigns_result = mysqli_query($con, $my_campaigns_query);

            if (mysqli_num_rows($my_campaigns_result)==0) {
                echo "<p>You haven't started any campaigns yet!";
            } else {
                echo "<div class='all-campaigns-container'>";
                while ($my_campaigns_record = mysqli_fetch_assoc($my_campaigns_result)) {
                    echo "<div class='campaign'>";
                    echo "<p><a href='campaign.php?id=" . $my_campaigns_record['PageID'] . "&fromurl=" . $_SERVER['REQUEST_URI'] . "'><img src='images/" . $my_campaigns_record['PageImage'] . "' alt='' class='allcampaignsimage'><br>" . $my_campaigns_record['FRFName'] . " " . $my_campaigns_record['FRLName'] . "'s fundraiser<br>";
                    echo $my_campaigns_record['PageGoal']."</a>";
                    echo "<br><a href='edit_page.php?id=".$my_campaigns_record['PageID']."'>Edit</a>";
                    echo "&nbsp&nbsp&nbsp&nbsp<a href=delete_page.php?id=".$my_campaigns_record['PageID']."'>Delete</a>";
                    echo "</div>\n";
                } echo "</div>";
            }
            ?>
        </main>
    </body>

</html>
<?php include 'session_connection.php';

// Redirect if user not logged in
if (!isset($_SESSION['user'])) {
    header("location:login_error_page.php");
} else {
    $user = $_SESSION['user'];
}

?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> My campaigns - Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='styles.css'>
    <!-- Small js function to confirm deletion -->
    <script type='text/javascript'>
        function openurl(newurl) {
            if (confirm("Are you sure you want to delete this page?")) {
                document.location = newurl;
            }
        }
    </script>
</head>

<body>
<header>
    <?php include 'header.php' ?>
</header>

<main>
    <h1>My campaigns</h1>
    <?php
    // Gets all of a specific fundraiser's campaigns
    $my_campaigns_query = "SELECT pages.PageID, pages.PageName, pages.PageGoal, pages.PageImage
                        FROM pages, fundraisers
                        WHERE pages.FundraiserID = fundraisers.FundraiserID AND fundraisers.FundraiserID = '$user'
                        ORDER BY pages.PageGoal";
    $my_campaigns_result = mysqli_query($con, $my_campaigns_query);

    if (mysqli_num_rows($my_campaigns_result) == 0) {
        echo "<p>You haven't started any campaigns yet!";
    } else {
        echo "<div class='all-campaigns-container'>";
        // For each campaign
        while ($my_campaigns_record = mysqli_fetch_assoc($my_campaigns_result)) {
            // Display (the title, icon, and goal of) said campaign
            echo "<div class='campaign'>";
            echo "<p><a href='campaign.php?id=" . $my_campaigns_record['PageID'] . "&fromurl=" . $_SERVER['REQUEST_URI']
                . "'><img src='images/" . $my_campaigns_record['PageImage'] . "' alt='' class='allcampaignsimage'><br>"
                . $my_campaigns_record['PageName'] . "<br>";
            echo $my_campaigns_record['PageGoal'] . "</a>";

            // Link to edit said campaign
            echo "<br><a href='edit_campaign.php?id=" . $my_campaigns_record['PageID'] . "'>Edit</a>";

            // Link to delete said campaign
            echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=javascript:openurl('delete_campaign.php?id=" . $my_campaigns_record['PageID'] . "')>Delete</a>";

            echo "</div>\n";
        }
        echo "</div>";
    }
    ?>
</main>
</body>

</html>
<?php
include 'session_connection.php';

// Redirects if user is not logged in
if (!isset($_SESSION['user'])) {
    header("location:login_error_page.php");
}

$user = $_SESSION['user'];
$page = mysqli_real_escape_string($con, $_GET['id']); // Passed through url, escaped just in case

$this_campaign_query = "SELECT FundraiserID FROM pages WHERE pages.PageID = '$page'";
$this_campaign_result = mysqli_query($con, $this_campaign_query);
$this_campaign_record = mysqli_fetch_assoc($this_campaign_result);

// Redirects if user does not own the page being deleted (since id can be changed in url)
if ($this_campaign_record['FundraiserID'] != $user) {
    header("location:account_error_page.php");
} else {
    $delete_page = "DELETE FROM pages WHERE PageID='$page'"; // Query to delete selected page
}
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
    // Check if deletion worked, display message accordingly
    if (mysqli_query($con, $delete_page)) {
        echo "<h1>Page deleted.</h1>
              <p>Redirecting...</p>";
        header("refresh:1; url=user_campaigns.php");
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again once redirected.";
        header("refresh:2; url=user_campaigns.php");
    }

    ?>
</main>
</body>

</html>
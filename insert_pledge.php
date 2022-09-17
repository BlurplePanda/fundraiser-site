<?php
include 'session_connection.php';

// Form results
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$amount = $_POST['amount'];
$page = $_POST['page']; // Campaign/page being pledged to
$fromurl = $_POST['url']; // Previous url

// Query to insert donor details into database
$insert_donor = "INSERT INTO donors (DonorFName, DonorLName, DonorEmail)
                 VALUES ('$fname', '$lname', '$email')";

// Check if donor insert worked
if (mysqli_query($con, $insert_donor)) {
    $donorinsert = true;
    $newdonorid = mysqli_insert_id($con); // The auto-generated/incremented ID of the just-inserted donor

    // Query to insert pledge details into database (using the new donor)
    $insert_pledge = "INSERT INTO pledges (DonorID, PageID, PledgeAmount) VALUES ($newdonorid, $page, $amount)";

    // Check if pledge insert worked
    if (!mysqli_query($con, $insert_pledge)) {
        $pledgeinsert = false;
    } else {
        $pledgeinsert = true;
    }
} else {
    $donorinsert = false;
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
    // Check if BOTH queries worked and display message accordingly
    if ($pledgeinsert && $donorinsert) {
        echo "<h1>Pledge successfully made!</h1>
              <p>Redirecting...";
        header("refresh: 1; url=$fromurl");
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again once redirected.";
        header("refresh: 2; url=$fromurl");
    }
    ?>
</main>
</body>

</html>
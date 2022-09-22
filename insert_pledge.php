<?php
include 'session_connection.php';

// Form results
$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$amount = mysqli_real_escape_string($con, $_POST['amount']);
$page = mysqli_real_escape_string($con, $_POST['page']); // Campaign/page being pledged to
$fromurl = mysqli_real_escape_string($con, $_POST['url']); // Previous url

// Check if donor already in database
$check_donor = "SELECT DonorID FROM donors WHERE DonorFName = '$fname' AND DonorLName = '$lname' AND DonorEmail = '$email'";
$check_donor_result = mysqli_query($con, $check_donor);
if (mysqli_num_rows($check_donor_result) == 1) {
    // If it is, set id for pledge to that donor id
    $newdonorid = mysqli_fetch_assoc($check_donor_result)['DonorID'];
    $donorinsert = true;
}
else {
    // Query to insert donor details into database
    $insert_donor = "INSERT INTO donors (DonorFName, DonorLName, DonorEmail)
                     VALUES ('$fname', '$lname', '$email')";

    // Check if donor insert worked
    if (mysqli_query($con, $insert_donor)) {
        $donorinsert = true;
        $newdonorid = mysqli_insert_id($con); // The auto-generated/incremented ID of the just-inserted donor
    }
    else {
        $donorinsert = false;
    }
}

if($donorinsert) {
    // Query to insert pledge details into database (using the new donor)
    $insert_pledge = "INSERT INTO pledges (DonorID, PageID, PledgeAmount) VALUES ('$newdonorid', '$page', '$amount')";

    // Check if pledge insert worked
    if (!mysqli_query($con, $insert_pledge)) {
        $pledgeinsert = false;
    } else {
        $pledgeinsert = true;
    }
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
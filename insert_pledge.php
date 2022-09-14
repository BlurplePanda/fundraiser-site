<?php
include 'session_connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$amount = $_POST['amount'];
$page = $_POST['page'];
$fromurl = $_POST['url'];

$insert_donor = "INSERT INTO donors (DonorFName, DonorLName, DonorEmail)
                 VALUES ('$fname', '$lname', '$email')";
if(mysqli_query($con, $insert_donor)){
    $donorinsert = true;
    $newdonorid = mysqli_insert_id($con);

    $insert_pledge = "INSERT INTO pledges (DonorID, PageID, PledgeAmount) VALUES ($newdonorid, $page, $amount)";
    if (!mysqli_query($con, $insert_pledge)){
        $pledgeinsert = false;
    }
    else {
        $pledgeinsert = true;
    }
}
else {
    $donorinsert = false;
}

header("refresh: 2; url=$fromurl");
?><!DOCTYPE html>

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
    <?php
    if($pledgeinsert && $donorinsert) {
        echo "<h1>Success!</h1>
              <p>Pledge successfully made :)";
    }
    else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again.";
    }
    echo "<p>Redirecting...";
    ?>
</main>
</body>

</html>
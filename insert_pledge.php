<?php
include 'session_connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$amount = $_POST['amount'];
$page = $_POST['page'];
$fromurl = $_POST['url'];

$insert_donor = "INSERT INTO donors (DonorFName, DonorLName, DonorEmail) VALUES ('$fname', '$lname', '$email')";
if(mysqli_query($con, $insert_donor)){
    $donorinsert = true;
    $get_inserted_id_query = "SELECT DonorID FROM donors WHERE DonorFName = '$fname' AND DonorLName = '$lname' AND DonorEmail = '$email'";
    $get_inserted_id_result = mysqli_query($con, $get_inserted_id_query);
    $get_inserted_id_record = mysqli_fetch_assoc($get_inserted_id_result);
    $id = $get_inserted_id_record['DonorID'];

    $insert_pledge = "INSERT INTO pledges (DonorID, PageID, PledgeAmount) VALUES ($id, $page, $amount)";
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

header("refresh: 3; url=$fromurl");
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
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
    ?>
</main>
</body>

</html>
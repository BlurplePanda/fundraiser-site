<?php
include 'session_connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pw = $_POST['pw'];
$bcrypt_pw = password_hash($pw, PASSWORD_BCRYPT);

$insert_account = "INSERT INTO fundraisers (FRFName, FRLName, FREmail, FRPassword)
                VALUES ('$fname', '$lname', '$email', '$bcrypt_pw')";
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
    if (mysqli_query($con, $insert_account)) {
        echo "<h1>Account created!</h1>
              <p>You may now log in.</p>";
        header("refresh:1; url=login.php");
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Looks like that didn't work. Please try again once redirected.";
        header("refresh:2; url=create_campaign.php");
    }
    ?>
</main>
</body>

</html>
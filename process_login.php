<?php
include 'session_connection.php';

// Form results
$email = mysqli_real_escape_string($con, $_POST['email']);
$pw = mysqli_real_escape_string($con, $_POST['password']);
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
    // Query to find account
    $login_query = "SELECT FundraiserID, FRPassword FROM fundraisers WHERE fundraisers.FREmail = '$email'";
    $login_result = mysqli_query($con, $login_query);
    $login_record = mysqli_fetch_assoc($login_result);

    // The (encrypted) password stored in the database
    $hash = $login_record['FRPassword'];

    // Check if the entered password matches the encrypted one
    $verify = password_verify($pw, $hash);

    // Display message and redirect accordingly
    if ($verify) {
        echo "<h1>Success!</h1>
              <p>Logged in. Redirecting...</p>";
        $_SESSION['user'] = $login_record['FundraiserID']; // Put ID of current "account" into a session variable
        header("refresh:1, url=index.php");
    } else {
        echo "<h1>Uh oh!</h1>
              <p>Incorrect email or password. Redirecting...";
        header("refresh:2, url=login.php");
    }
    ?>
</main>
</body>

</html>
<?php
    session_start();
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

$email = $_POST['email'];
$pw = $_POST['password'];
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <img src='images/rundfaise-logo.png' alt='Rundfaise logo and text: Donate - Support - Fundraise' class='center'>
    <nav>
        <a href='index.php' class='button' id='current'> Home </a>
        <a href='campaignlist.php' class='button'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <?php
    $login_query = "SELECT FundraiserID, FRPassword FROM fundraisers WHERE fundraisers.FREmail = '$email'";
    $login_result = mysqli_query($con, $login_query);
    $login_record = mysqli_fetch_assoc($login_result);

    $hash = $login_record['FRPassword'];

    $verify = password_verify($pw, $hash);
    if($verify) {
        echo "<h1>Success!</h1>
              <p>Logged in. Redirecting...</p>";
        $_SESSION['user'] = $login_record['FundraiserID'];
        header("refresh:2, url=index.php");
    }
    else {
        echo "<h1>Uh oh!</h1>
              <p>Incorrect username or password. Redirecting...";
        header("refresh:2, url=login.php");
    }
    ?>
</main>
</body>

</html>
<?php include 'session_connection.php';
if(!isset($_SESSION['user'])){
    header("location:login_error_page.php");
}
$user = $_SESSION['user'];
$page = $_GET['id'];
$this_campaign_query = "SELECT * FROM pages WHERE pages.PageID = '$page'";
$this_campaign_result = mysqli_query($con, $this_campaign_query);
$this_campaign_record = mysqli_fetch_assoc($this_campaign_result);
if($this_campaign_record['FundraiserID']!=$user) {
    header("location:account_error_page.php");
}
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Edit campaign - Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='styles.css'>
</head>

<body>
<header>
    <?php include 'header.php'?>
</header>

<main>

</main>
</body>

</html>
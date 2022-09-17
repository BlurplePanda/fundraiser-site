<?php include 'session_connection.php';
// Redirects if user is not logged in
if (!isset($_SESSION['user'])) {
    header("location:login_error_page.php");
}
$user = $_SESSION['user'];
$page = $_GET['id']; // Passed through url

$this_campaign_query = "SELECT * FROM pages WHERE pages.PageID = '$page'";
$this_campaign_result = mysqli_query($con, $this_campaign_query);
$this_campaign_record = mysqli_fetch_assoc($this_campaign_result);

// Redirects if user does not own the page being edited (since id can be changed in url)
if ($this_campaign_record['FundraiserID'] != $user) {
    header("location:account_error_page.php");
}

// For efficiency!
$title = $this_campaign_record['PageName'];
$charity = $this_campaign_record['ChosenCharity'];
$desc = $this_campaign_record['PageDesc'];
$image = $this_campaign_record['PageImage'];
$goal = $this_campaign_record['PageGoal'];
?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Edit campaign - Rundfaise </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='styles.css'>
</head>

<body>
<header>
    <?php include 'header.php' ?>
</header>

<main>
    <h1>Edit your campaign</h1>

    <!-- Form to alter campaign details, default values are current details -->
    <form action='update_campaign.php' method='post'>

        <label for='title'>Title:</label>
        <input type='text' id='title' name='title' value='<?php echo $title ?>'><br>

        <label for='charity'>Charity:</label>
        <input type='text' id='charity' name='charity' value='<?php echo $charity ?>'><br>

        <label for='desc'>Campaign description:</label>
        <textarea id='desc' name='desc'><?php echo $desc ?></textarea><br>

        <!-- Image radio group -->
        <table>
            <caption>Image:
                <?php
                // If image not one of the four in radio group, warn user
                if ($image != "food.png"
                    && $image != "Public-health-icon.png"
                    && $image != "learn-icon.png"
                    && $image != "money.png") {
                    echo "<br>Your image is not available to be re-chosen. If you wish to keep it the same, do not select a new image.";
                    echo "<input type='hidden' id='currimg' name='currimg' value='$image'>";
                } ?></caption>

            <!-- Each cell contains an option -->
            <tr>
                <td><input type='radio' id='food' name='img' value='food.png' <?php
                    // If the current image is "food.png", make the radio button checked by default
                    if ($image == "food.png") {
                        echo "checked";
                    } ?>>
                    <label for='food'><img src='images/food.png' class='choose-image'></label></td>

                <td><input type='radio' id='health' name='img' value='Public-health-icon.png' <?php
                    if ($image == "Public-health-icon.png") {
                        echo "checked";
                    } ?>>
                    <label for='health'><img src='images/Public-health-icon.png' class='choose-image'></label></td>

                <td><input type='radio' id='education' name='img' value='learn-icon.png' <?php
                    if ($image == "learn-icon.png") {
                        echo "checked";
                    } ?>>
                    <label for='education'><img src='images/learn-icon.png' class='choose-image'></label></td>

                <td><input type='radio' id='money' name='img' value='money.png' <?php
                    if ($image == "money.png") {
                        echo "checked";
                    } ?>>
                    <label for='money'><img src='images/money.png' class='choose-image'></label></td>
            </tr>
        </table>

        <label for='goal'>Campaign goal:</label>
        <input type='number' step='0.01' min='0' max='9999999.99' id='goal' name='goal' value='<?php echo $goal ?>'>

        <!-- Hidden input to pass the PageID to form action page -->
        <input type='hidden' id='page' name='page' value='<?php echo $page ?>'>

        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form>
</main>
</body>

</html>
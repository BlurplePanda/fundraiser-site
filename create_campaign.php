<?php include 'session_connection.php';
if (!isset($_SESSION['user'])) {
    header("location:login_error_page.php");
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
    <h1>Create a fundraising campaign</h1>

    <!-- "Create campaign" form -->
    <form action='insert_campaign.php' method='post'>

        <label for='title'>Title:</label>
        <input type='text' id='title' name='title' maxlength='48' required><br>

        <label for='charity'>Charity:</label>
        <input type='text' id='charity' name='charity' maxlength='64' required><br>

        <label for='desc'>Campaign description:</label>
        <textarea id='desc' name='desc' maxlength='500' required></textarea><br>

        <!-- Image radio group -->
        <table>
            <caption>Image:</caption>
            <!-- Each cell contains an option -->
            <tr>
                <!-- required attribute: https://stackoverflow.com/a/8287947 -->
                <td><input type='radio' id='food' name='img' value='food.png' required>
                    <label for='food'><img src='images/food.png' alt='Icon of food in a bowl'
                                           class='choose-image'></label></td>
                <td><input type='radio' id='health' name='img' value='Public-health-icon.png' required>
                    <label for='health'><img src='images/Public-health-icon.png' alt='Hands and plus sign health icon'
                                             class='choose-image'></label></td>
                <td><input type='radio' id='education' name='img' value='learn-icon.png' required>
                    <label for='education'><img src='images/learn-icon.png' alt='Person reading icon'
                                                class='choose-image'></label></td>
                <td><input type='radio' id='money' name='img' value='money.png' required>
                    <label for='money'><img src='images/money.png' alt='Icon of money (cash)'
                                            class='choose-image'></label></td>
            </tr>
        </table>

        <label for='goal'>Campaign goal:</label>
        <input type='number' step='0.01' min='0' max='9999999.99' id='goal' name='goal' required>

        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form>
    <br>
</main>
</body>

</html>
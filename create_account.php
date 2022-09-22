<?php include 'session_connection.php';
if (isset($_SESSION['user'])) {
    header("location:logout_error_page.php");
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
    <h1>Create a fundraiser account</h1>
    <p>Please note: Donors do not need to create an account in order to make pledges.</p>

    <!-- Create account form -->
    <form action='insert_account.php' method='post'>
        <label for='fname'>First name:</label>
        <input type='text' id='fname' name='fname' maxlength='48' required><br>

        <label for='lname'>Last name:</label>
        <input type='text' id='lname' name='lname' maxlength='72' required><br>

        <label for='email'>Email address:</label>
        <input type='email' id='email' name='email' maxlength='254' required><br>

        <label for='pw'>Password:</label>
        <input type='password' id='pw' name='pw' maxlength='255' required><br>

        <!-- Submit button -->
        <input type='submit' value='Submit'>
    </form>
    <br>
</main>
</body>

</html>
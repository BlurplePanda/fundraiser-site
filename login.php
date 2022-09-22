<?php include 'session_connection.php';
// Redirect if user is already logged in
if (isset($_SESSION['user'])) {
    header("location:logout_error_page.php");
}?><!DOCTYPE html>

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
    <h1>Log In</h1>

    <!--Login form-->
    <form name='login_form' id='login_form' method='post' action='process_login.php'>
        <label for='email'>Email address:</label>
        <input type='email' id='email' name='email' maxlength='254' required><br>

        <label for='password'>Password:</label>
        <input type='password' id='password' name='password' maxlength='255' required><br>

        <input type='submit' value='Log in'>
    </form>

    <!-- Link to "create account" page -->
    <p>Don't have an account? Click <a href='create_account.php'>here.</a></p>

</main>
</body>

</html>
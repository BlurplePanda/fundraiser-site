<?php include 'connection.php'?><!DOCTYPE html>

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
        <a href='campaign_list.php' class='button'> Campaigns </a>
        <a href='login.php' class='button'> Log In </a>

    </nav>
</header>

<main>
    <h1>Log In</h1>
    <!--Login form-->
    <form name='login_form' id='login_form' method='post' action='process_login.php'>
        <label for='email'>Email address:</label>
        <input type='email' id='email' name='email'><br>

        <label for='password'>Password:</label>
        <input type='password' id='password' name='password'><br>

        <input type='submit' value='Log in'>
    </form>

</main>
</body>

</html>
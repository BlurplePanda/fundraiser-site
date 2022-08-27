<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

if($_SERVER['REQUEST_METHOD']=='POST') {
    $file = $_FILES['img'];
    $filename = $file['name'];
    $filetmpname = $file['tmp_name'];
    $filesize = $file['size'];
    $fileerror = $file['error'];
    $fileext = strtolower(end(explode('.', $filename)));
    $filenamenew = uniqid('', true).".".$fileext;
    move_uploaded_file($filetmpname, 'images/'.$filenamenew);
}
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
        <a href='campaign_list.php' class='button'> Campaigns </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>

</main>
</body>

</html>
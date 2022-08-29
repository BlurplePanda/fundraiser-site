<?php
$include 'session_connection.php';

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
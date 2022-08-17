<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");
if(mysqli_connect_errno()){
   echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

?><!DOCTYPE html>

<html lang='en'>

   <head>
      <title> Rundfaise </title>
      <meta charset='utf-8'>
      <link rel='stylesheet' type='text/css' href='style.css'>
   </head>

   <body>
      <header>
          <img src='' alt='Rundfaise logo' class='center'>
          <nav>
              <a href='index.php' class='button' id='current'> Home </a>
              <a href='campaignlist.php' class='button'> Campaigns </a>
              <a href='specials.php' class='button'> Specials </a>

          </nav>
      </header>

      <main>
          <h1>Rundfaise</h1>
          <p>Fundraiser platform for various charities blah blah blah :D</p>
          <img id='home-page-image' src='' alt='A cartoon hand holding/giving a love heart'>


      </main>
   </body>

</html>
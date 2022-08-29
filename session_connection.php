<?php
session_start();
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

?>
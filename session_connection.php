<?php
// Start session (needs to happen on every page in my site)
session_start();

// Connect to database
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_fundraisers");

// Display message if didn't connect properly
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:" . mysqli_connect_error();
    die();
}

?>
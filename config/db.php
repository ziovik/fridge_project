<?php

//db details
$dbHost = 'localhost';
$dbUsername = 'nd';
$dbPassword = 'Rjynbytyn_123';
$dbName = 'fridges';

//Connect and select the database
$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Change character set to utf8
mysqli_set_charset($con,"utf8");

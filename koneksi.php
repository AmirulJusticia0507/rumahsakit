<?php
// Database configuration
$host = "localhost"; // Change this if your database server is different
$database = "rumahsakit_Amirul_db";
$username = "root";
$password = "";

// Create a mysqli connection
$koneksiku = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($koneksiku->connect_errno) {
    die("Failed to connect to MySQL: " . $koneksiku->connect_error);
}

// Connection is successful
//echo "Connected to the database!";
?>

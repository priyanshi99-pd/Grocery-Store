<?php
$servername = "localhost";     // Change if your DB is hosted elsewhere
$username   = "root";          // Your MySQL username
$password   = "";              // Your MySQL password (keep it blank for XAMPP default)
$database   = "typroj"; // Your database name (you can change it as needed)

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

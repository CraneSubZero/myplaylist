<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "music";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Handle error by stopping the script
}

// No need to output "Connection successful" in production
// If you want to log connection status, you can use comments or write to a log file
// Example for logging connection status (optional):
// error_log("Database connection successful.", 3, "/path/to/logfile.log");
?>
<?php
$servername = "localhost"; // localhost
$username = "root"; // username default
$password = "mysql"; // username default
$dbname = "frugal_company"; // DB-name in mySQL

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; // This will show when running successfully.
?>

<?php
$servername = "localhost";   // or use "127.0.0.1"
$username = "root";          // default XAMPP/WAMP username
$password = "";              // default is empty
$database = "agrirent";      // replace with your actual DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully"; // Optional: for testing
?>

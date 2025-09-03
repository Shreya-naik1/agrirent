<?php
// Database connection settings
$servername = "localhost";
$username = "root";       // default in XAMPP
$password = "";           // default in XAMPP
$dbname = "agrirent_db";  // correct database name

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for DB connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $plain_password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Check if email already exists using prepared statement
    $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('Email already registered. Please use a different email or login.');
                window.location.href = 'register.html';
              </script>";
    } else {
        // Insert new user using prepared statement
        $insertStmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $name, $email, $hashed_password);

        if ($insertStmt->execute()) {
            echo "<script>
                    alert('Registration Successful! Please login.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error during registration. Please try again.');
                    window.history.back();
                  </script>";
        }

        $insertStmt->close();
    }

    $checkEmailStmt->close();
}

$conn->close();
?>

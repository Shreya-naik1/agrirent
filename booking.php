<?php include('server.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Equipment - AgriRent</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>

    <header>
        <h1>AgriRent</h1>
        <nav>
            <ul class="nav-bar">
                <li><a href="index.html">Home</a></li>
                <li><a href="equipment.html">Equipment</a></li>
                <li><a href="booking.html">Book Now</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Book Your Equipment</h2>
        <form class="booking-form">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Delivery Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="equipment">Select Equipment:</label>
            <select id="equipment" name="equipment" required>
                <option value="" disabled selected>-- Choose Equipment --</option>
                <option value="Tractor">Tractor</option>
                <option value="Tiller">Tiller</option>
                <option value="Harvester">Harvester</option>
                <option value="Plough">Plough</option>
                <option value="Seeder">Seeder</option>
                <option value="Sprayer">Sprayer</option>
                <option value="Rotavator">Rotavator</option>
                <option value="Cultivator">Cultivator</option>
                <option value="Baler">Baler</option>
                <option value="Axe">Axe</option>
                <option value="thresher">thresher</option>
                <option value="gardening-tools">gardening-tools</option>
            </select>

            <label for="rental-days">Number of Days:</label>
            <input type="number" id="rental-days" name="rental-days" min="1" required>

            <button type="submit">Confirm Booking</button>
        </form>
    </main>

    <footer>&copy; 2025 AgriRent. All Rights Reserved.</footer>



<form class="booking-form" action="book.php" method="POST">

<?php
// Step 1: Connect to database
$conn = new mysqli("localhost", "root", "", "agrirent_db"); // Replace with your DB name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $equipment = $_POST['equipment'];
    $days = $_POST['rental-days'];

    // Step 3: Insert into bookings table
    $sql = "INSERT INTO bookings (customer_name, phone_number, address, equipment_name, rental_days)
            VALUES ('$name', '$phone', '$address', '$equipment', '$days')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Booking Successful!</h2><p><a href='equipment.html'>Back to Equipment</a></p>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>
</body>
</html>

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE equipment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  image VARCHAR(255),
  price INT
);
INSERT INTO equipment (name, description, image, price) VALUES
('Tractor', 'Powerful 55HP tractor suitable for ploughing, tilling, and hauling.', 'tracter.jpg', 1500),
('Harvester', 'Efficient multi-crop harvester for fast and easy harvesting.', 'harvester.jpg', 2500),
('Plough', 'Used for initial soil preparation before sowing crops.', 'plough.jpg', 700),
('Seed Drill', 'Ensures even distribution of seeds for better yield.', 'seeddrill.jpg', 800),
('Crop Sprayer', 'Used for pesticide and fertilizer spraying across fields.', 'spray.jpg', 600),
('Cultivator', 'Helps in soil stirring and weed control before planting.', 'cultivator.jpg', 900),
('Hay Baler', 'Collects cut grass and forms compact bales for easy storage.', 'baler.jpeg', 1200),
('Thresher', 'Separates grains from harvested crops quickly and cleanly.', 'thresher.png', 1200),
('Rotavator', 'Ideal for land preparation and mixing soil before planting.', 'rotavator.jpg', 1100),
('Tiller', 'Ideal for soil preparation and weed control in small to medium fields.', 'tiller.jpg', 1100),
('Axe', 'Perfect for chopping wood and clearing small branches.', 'axe.jpg', 500),
('Gardening Tools', 'Essential for planting, pruning, and maintaining home gardens.', 'gardening-tools.jpg', 400);
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  phone VARCHAR(20),
  address TEXT,
  equipment VARCHAR(100),
  rental_days INT,
  booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO bookings (name, phone, address, equipment, rental_days)
VALUES 
('Ravi Kumar', '9876543210', '123 Green Field, Village A', 'Tractor', 3),
('Anjali Sharma', '9823456789', '45 Agri Lane, Town B', 'Harvester', 2),
('Suresh Mehta', '9123456780', '78 Crop Street, City C', 'Plough', 5),
('Meena Verma', '9876512345', '202 Farm Road, Village D', 'Cultivator', 4),
('Amit Joshi', '9898989898', '11 Seed Street, District E', 'Seed Drill', 6),
('Priya Desai', '9765432109', '77 Agri Colony, Town X', 'Tiller', 2),
('Vikram Rao', '9845678901', '33 Harvest Path, Region Y', 'Rotavator', 3);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);
INSERT INTO users (email, password)
VALUES 
('farmer1@example.com', 'pass123'),
('farmer2@example.com', 'welcome123'),
('admin@agrirent.com', 'admin123');

<div class="equipment-container">
  <?php
    include 'server.sql';

    $sql = "SELECT * FROM equipment";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="equipment-card">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
        echo '<h3>' . $row["name"] . '</h3>';
        echo '<p>' . $row["description"] . '</p>';
        echo '<span class="price">₹' . $row["price"] . '/day</span>';
        echo '</div>';
      }
    } else {
      echo '<p>No equipment found.</p>';
    }

    mysqli_close($conn);
  ?>
</div>


<?php include 'server.sql';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Escape inputs (for safety)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Check user
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Valid login
        echo "<script>alert('Login successful!'); window.location.href='index.html';</script>";
    } else {
        // Invalid login
        echo "<script>alert('Invalid email or password!'); window.location.href='login.html';</script>";
    }
}
?>

<?php include 'server.sql'; // Reuse the same connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $equipment = $_POST["equipment"];
    $days = $_POST["rental-days"];

    $sql = "INSERT INTO bookings (name, phone, address, equipment, rental_days)
            VALUES ('$name', '$phone', '$address', '$equipment', $days)";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Booking Confirmed!</h2>";
        echo "<p>Thank you, $name. You booked <strong>$equipment</strong> for <strong>$days day(s)</strong>.</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<?php include('server.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AgriRent - Equipments</title>
  <link rel="stylesheet" href="equipment.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">AgriRent</div>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="equipment.html">Equipments</a></li>
      <li><a href="booking.html">Bookings</a></li> 
      <li><a href="login.html">Login</a></li>
    </ul>
  </nav>

  <!-- Page Title -->
  <h1 class="page-title">Available Equipments</h1>

  <!-- Equipment Cards -->
  <div class="equipment-container">

    <!-- Equipment 1 -->
    <div class="equipment-card">
      <img src="tracter.jpg" alt="Tractor">
      <h3>Tractor</h3>
      <p>Powerful 55HP tractor suitable for ploughing, tilling, and hauling.</p>
      <span class="price">₹1500/day</span>
      
    </div>

    <!-- Equipment 2 -->
    <div class="equipment-card">
      <img src="harvester.jpg" alt="Harvester">
      <h3>Harvester</h3>
      <p>Efficient multi-crop harvester for fast and easy harvesting.</p>
      <span class="price">₹2500/day</span>
     
    </div>

    <!-- Equipment 3 -->
    <div class="equipment-card">
      <img src="plough.jpg" alt="Plough">
      <h3>Plough</h3>
      <p>Used for initial soil preparation before sowing crops.</p>
      <span class="price">₹700/day</span>

    </div>

    <!-- Equipment 4 -->
    <div class="equipment-card">
      <img src="seeddrill.jpg" alt="Seed Drill">
      <h3>Seed Drill</h3>
      <p>Ensures even distribution of seeds for better yield.</p>
      <span class="price">₹800/day</span>
     
    </div>

    <!-- Equipment 5 -->
    <div class="equipment-card">
      <img src="spray.jpg" alt="Sprayer">
      <h3>Crop Sprayer</h3>
      <p>Used for pesticide and fertilizer spraying across fields.</p>
      <span class="price">₹600/day</span>
    
    </div>

    <!-- Equipment 6 -->
    <div class="equipment-card">
      <img src="cultivator.jpg" alt="Cultivator">
      <h3>Cultivator</h3>
      <p>Helps in soil stirring and weed control before planting.</p>
      <span class="price">₹900/day</span>
 
    </div>

    <!-- Equipment 7 -->
    <div class="equipment-card">
      <img src="baler.jpeg" alt="Baler">
      <h3>Hay Baler</h3>
      <p>Collects cut grass and forms compact bales for easy storage.</p>
      <span class="price">₹1200/day</span>
     
    </div>

    <!-- Equipment 8 -->
    <div class="equipment-card">
      <img src="thresher.png" alt="Thresher">
      <h3>Thresher</h3>
      <p>Separates grains from harvested crops quickly and cleanly.</p>
      <span class="price">₹1200/day</span>
    </div>

    <!-- Equipment 9 -->
    <div class="equipment-card">
      <img src="rotavator.jpg" alt="Rotavator">
      <h3>Rotavator</h3>
      <p>Ideal for land preparation and mixing soil before planting.</p>
      <span class="price">₹1100/day</span>
     
    </div>

    
    <!-- Equipment 10 -->
    <div class="equipment-card">
        <img src="tiller.jpg" alt="Tiller">
        <h3>Tiller</h3>
        <p>Ideal for soil preparation and weed control in small to medium fields.</p>
        <span class="price">₹1100/day</span>
       
      </div>

      
    <!-- Equipment 11 -->
    <div class="equipment-card">
        <img src="axe.jpg" alt="Axe">
        <h3>Axe</h3>
        <p>Perfect for chopping wood and clearing small branches.</p>
        <span class="price">₹500/day</span>
       
      </div>

      
    <!-- Equipment 12 -->
    <div class="equipment-card">
        <img src="gardening-tools.jpg" alt="gardening-tools">
        <h3>gardening-tools</h3>
        <p>Essential for planting, pruning, and maintaining home gardens.</p>
        <span class="price">₹400/day</span>
       
      </div>
  
  </div>


<?php
// 1. Connect to the database
$conn = new mysqli("localhost", "root", "", "agrirent_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Fetch all equipment data
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AgriRent - Equipments</title>
  <link rel="stylesheet" href="equipment.css" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="logo">AgriRent</div>
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="equipment.php">Equipments</a></li>
    <li><a href="booking.html">Bookings</a></li>
    <li><a href="login.html">Login</a></li>
  </ul>
</nav>

<!-- Page Title -->
<h1 class="page-title">Available Equipments</h1>

<!-- Equipment Cards -->
<div class="equipment-container">
<?php
// 3. Loop through and show equipment cards
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '
        <div class="equipment-card">
            <img src="' . $row["image"] . '" alt="' . $row["name"] . '">
            <h3>' . $row["name"] . '</h3>
            <p>' . $row["description"] . '</p>
            <span class="price">₹' . $row["price"] . '/day</span>
        </div>';
    }
} else {
    echo "<p>No equipment available right now.</p>";
}
$conn->close();
?>
</div>

</body>
</html>

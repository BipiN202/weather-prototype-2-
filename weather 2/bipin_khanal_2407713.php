
<!--


* Student Name: Bipin khanal


* Student ID: 2407713


-->


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  <!--declare the character encoding for html-->
  <title>Simple Weather Website</title>
  <link rel="stylesheet" href="bipin_khanal_2407713.css"> <!--link css file--> 
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> <!--link font and import "open sans font " from google font -->
</head>
<body > <!--structure of weather website--> 
<div class="backimg"></div>
    
    <div class="container">
        <h1>Weather Forecast</h1>
        <div class="search">
            <input type="text" id="city" placeholder="Enter city name">
            <button><img src="https://raw.githubusercontent.com/BipiN202/weather-api/main/search.png" alt="error"></button>
        </div>
    
        <div class="weather">
            <img src="https://raw.githubusercontent.com/BipiN202/weather-api/main/images/wind.png" class="weather-icon">
            <p class="weather-type">Rainy</p>
            <h1 class="temp"></h1>
            <h2 class="city"></h2>
            <p class="date">December 22, 2023</p>
            <div class="details">
                <div class="col">
                    <img src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/humidity.png">
                    <div>
                        <p class="humidity"></p>
                        <p>Humidity</p>
                    </div>
                </div>
                <div class="col">
                    <img src="https://raw.githubusercontent.com/BipiN202/weather-api/main/images/wind.png">
                    <div>
                        <p class="wind"></p>
                        <p>Wind Speed</p>
                    </div>
            </div>          
        </div>
        <div class="pre">
            <div class="col">
                <img src="https://raw.githubusercontent.com/BipiN202/weather-api/main/images/pre.png">
                <div>
                    <p class="pressure"></p>
                    <p>Pressure</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>

        &copy; 2024 Simple Weather Website | Created by Bipin Khanal (Student ID: 2407713)
    </p>
</div>



<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "weather"; 

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display weather history
$sql = "SELECT * FROM weather WHERE date > now() - INTERVAL 7 day   ORDER BY date DESC LIMIT 7";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Date</th><th>City</th><th>Temperature (°C)</th><th>Humidity (%)</th><th>Wind Speed (km/h)</th><th>pressure</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["temperature"] . "</td>";
        echo "<td>" . $row["humidity"] . "</td>";
        echo "<td>" . $row["windspeed"] . "</td>";
        echo "<td>" . $row["pressure"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No weather data available.";
}

$conn->close();
?>

    <script src="bipin_khanal_2407713.js"></script>
</body>
</html>

<?php
//student name:Bipin Khanal
//student id :2407713

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$con = new mysqli("localhost", "root", "");
$con->query("create database if not exists weather");
$con->select_db("weather");
//create weather data tabel
$con->query("create table if not exists weather(
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(20),
    temperature INT,
    humidity INT,
    pressure INT,
    windspeed INT,
    description VARCHAR(20),
    date DATE
)");

if (isset($_GET["city"])) {
    $city = $_GET["city"];
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?units=metric&q=".$city."&appid=868f28d7fefbd205413b8706cb04001c";
    $data = file_get_contents($apiUrl);
    $data = json_decode($data);

    $temperature = $data->main->temp;
    $humidity = $data->main->humidity;
    $pressure = $data->main->pressure;
    $windspeed = $data->wind->speed;
    $description = $data->weather[0]->description;
    $date = date('y-m-d');

    $result = $con->query("SELECT * FROM weather WHERE city = '$city'");
    
        $con->query("INSERT INTO weather (city, temperature, humidity, pressure, windspeed, description, date) VALUES('$city', $temperature, $humidity, $pressure, $windspeed, '$description', '$date')");
    
} else {
    echo "City not specified.";
}
$con->close();
?>

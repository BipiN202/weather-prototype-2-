
<?php
//student name:Bipin Khanal
//student id :2407713
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$city = isset($_GET['city']) ? $_GET['city']: "nandyal";
$con = new mysqli("localhost", "root", "", "weather");
$result = $con->query("select * from weather where city ='$city'");
if ($result->num_rows == 0) {
    include "main.php";
    
    $result = $con->query("select * from weather where city ='$city'");
}
$row = $result->fetch_assoc();
echo json_encode($row);
?>
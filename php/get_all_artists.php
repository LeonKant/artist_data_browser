<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername="localhost";
$username="AdminLab11";
$password="4VPnroTOC6wOU3mn";
$dbname = "artistsLab11";

$conn = new mysqli($servername,$username,$password,$dbname);

$stmt = $conn->query('SELECT * FROM Artist');
$artists = $stmt->fetch_all(MYSQLI_ASSOC);

echo json_encode($artists);

?>
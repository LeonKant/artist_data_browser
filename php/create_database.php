<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername="localhost";
$username="AdminLab11";
$password="4VPnroTOC6wOU3mn";
$dbname = "artistsLab11";

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error ."<br>");
}
echo "Connected successfully <br>";

$sql = 'DROP DATABASE artistsLab11';
if ($conn->query($sql)) {
    echo "Database myDB was successfully dropped<br>";
} else {
    echo 'Error dropping database: ' . $conn->error . "<br>"; 
	// mysql_error() not working with PHP7 use $conn->error
}	

$sql = "CREATE DATABASE artistsLab11";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}

$conn->close();
echo "Connection closed <br>";

$conn = new mysqli($servername, $username, $password,$dbname);

$sql = "CREATE TABLE Artist (
pkey INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
band_name VARCHAR(30) NOT NULL,
latest_album_name VARCHAR(30) NOT NULL,
year INT(10) NOT NULL,
is_group BOOLEAN NOT NULL,
genre VARCHAR(30) NOT NULL,
image_url VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Artist created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

$conn->close()

?>
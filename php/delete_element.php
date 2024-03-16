<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername="localhost";
$username="AdminLab11";
$password="4VPnroTOC6wOU3mn";
$dbname = "artistsLab11";

$conn = new mysqli($servername, $username, $password,$dbname);

if(isset($_GET["index"])){
    $index =((int)$_GET["index"]);
}

echo "index: ".strval($index);

$sql = "DELETE FROM Artist WHERE pkey=".$index;

if ($conn->query($sql) === TRUE) {
    echo "Artist deleted <br>";
} else {
    echo "Error deleting artist: " . $conn->error ."<br>";
} 

//-- Step 1: Create a temporary table with the same structure
$sql = "CREATE TEMPORARY TABLE temp_artists AS SELECT * FROM Artist ORDER BY pkey";

if ($conn->query($sql) === TRUE) {
    echo "Temp Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
} 

//-- Step 2: Drop the original table
$sql = "DROP TABLE Artist";

if ($conn->query($sql) === TRUE) {
    echo "original table dropped successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

//-- Step 3: Recreate the original table with the same structure
$sql = "CREATE TABLE Artist (
pkey INT(6) AUTO_INCREMENT PRIMARY KEY,
band_name VARCHAR(30) NOT NULL,
latest_album_name VARCHAR(30) NOT NULL,
year INT(10) NOT NULL,
is_group BOOLEAN NOT NULL,
genre VARCHAR(30) NOT NULL,
image_url VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Artist table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

//-- Step 4: Insert the data back into the original table with re-ordered primary keys
$sql = "INSERT INTO Artist (band_name, latest_album_name, year, is_group, genre, image_url)
SELECT band_name, latest_album_name, year, is_group, genre, image_url
FROM temp_artists 
ORDER BY pkey";

if ($conn->query($sql) === TRUE) {
    echo "temp table inserted successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

//-- Step 5: Drop the temporary table

$sql = "DROP TABLE temp_artists";

if ($conn->query($sql) === TRUE) {
    echo "temp table dropped successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

$sql = "SELECT * FROM Artist";
$result = $conn->query($sql);
$num_rows = mysqli_num_rows($result);

$sql = "ALTER TABLE Artist AUTO_INCREMENT = $num_rows";

if ($conn->query($sql) === TRUE) {
    echo "changed index successfully<br>";
} else {
    echo "Error changing index: " . $conn->error ."<br>";
}

$conn->close();

?>
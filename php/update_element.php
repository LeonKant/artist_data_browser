<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["index"])){
    $index =((int)$_POST["index"])+1;
}

$json_object = json_decode($_POST["data"],true);

$servername="localhost";
$username="AdminLab11";
$password="4VPnroTOC6wOU3mn";
$dbname = "artistsLab11";

$conn = new mysqli($servername,$username,$password,$dbname);

$name =        $json_object["name"];
$latestAlbum = $json_object["latestAlbum"];
$year =        $json_object["year"];
$isGroup =     $json_object["isGroup"];
$genre =       $json_object["genre"];

$sql = "UPDATE Artist SET band_name='" . $name ."', 
latest_album_name='" .$latestAlbum . "', 
year='" .$year . "', 
is_group='".$isGroup."', 
genre='". $genre ."' 
WHERE pkey=". strval($index);

$result = $conn->query($sql);

echo "updated artist"
?>
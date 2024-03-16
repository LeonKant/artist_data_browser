<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "artist.php";

if(isset($_GET["index"])){
    $index =((int)$_GET["index"])+1;
}
$servername="";
$username="";
$password="";
$dbname = "";

$conn = new mysqli($servername,$username,$password,$dbname);

$sql = "SELECT band_name, latest_album_name, year, is_group, genre, image_url FROM Artist WHERE pkey=". strval($index)." LIMIT 1";

$result = $conn->query($sql);


if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $newartist = new Artist();

    $newartist->setBandName($row['band_name']);
    $newartist->setAlbumName($row['latest_album_name']);
    $newartist->setYear($row['year']);
    $newartist->setIsGroup($row['is_group']);
    $newartist->setGenre($row['genre']);
    $newartist->setImage($row['image_url']);

    $sql = "SELECT * FROM Artist";
    $result = $conn->query($sql);
    $num_rows = mysqli_num_rows($result);

    echo json_encode(["artist"=>json_encode($newartist), "numArtists" => $num_rows]);
}else{
    echo "error sending artist";
}
?>
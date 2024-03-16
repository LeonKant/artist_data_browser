<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername="localhost";
$username="AdminLab11";
$password="4VPnroTOC6wOU3mn";
$dbname = "artistsLab11";
$conn = new mysqli($servername, $username, $password,$dbname);

$stmt = $conn->prepare("INSERT INTO Artist (band_name,latest_album_name,year,is_group,genre,image_url) VALUES (?,?,?,?,?,?)");

$stmt->bind_param("ssiiss",$band_name, $latest_album, $year, $is_group, $genre, $image_url);

$artists_string = file_get_contents("artists.json");
$artists_json = json_decode($artists_string,true);
$n = count($artists_json);
echo $n . "<br>";
echo $artists_string . "<br>";
echo $artists_json[0]["name"];

for($i = 0; $i<$n; $i++){
	$band_name= $artists_json[$i]["name"];
	$latest_album=$artists_json[$i]["latestAlbum"];
	$year=$artists_json[$i]["year"];
	$is_group=$artists_json[$i]["isGroup"];
	$genre=$artists_json[$i]["genre"];
	$image_url=$artists_json[$i]["image"];

	echo "image url: " . $image_url . "<br>";

	echo "image char count: " . strval(strlen($image_url)) . "<br>";
	echo "Index: " . strval($i) . "<br><br>"; 

	$stmt->execute();

	if ($stmt==FALSE) {
		echo "There is a problem with prepare <br>";
		echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
		break;
	}
}
echo "Successfully added artists <br>";
$conn->close()
?>
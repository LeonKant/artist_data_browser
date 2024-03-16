<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername="";
$username="";
$password="";
$dbname = "";

include "artist.php";

// echo $_POST["nameText"];

// $artist_string = $_POST['newArtist'];
// $artist_assoc_arr = json_decode($artist_string,true);

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error ."<br>");
}

$stmt = $conn->prepare("INSERT INTO Artist (band_name,latest_album_name,year,is_group,genre,image_url) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssiiss",$band_name, $latest_album, $year, $is_group, $genre, $image_url);

$band_name=   $_POST["name_text"];
$latest_album=$_POST["album_text"];
$year=        $_POST["year_text"];
$is_group=    $_POST["group_text"];
$genre=       $_POST["genre_text"];

echo $_POST["name_text"] . '<br>';
echo $_POST["album_text"] . '<br>';
echo $_POST["year_text"] . '<br>';
echo $_POST["group_text"] . '<br>';
echo $_POST["genre_text"] . '<br>';

$upload_dir = "../images/";
$upload_file = $upload_dir . basename($_FILES["imageup"]["name"]);

echo "upload file:" . substr($upload_file,3) . "<br>";
echo "temp_image_name:" . $_FILES["imageup"]["tmp_name"] ."<br>";

$uploadOk = 1;

$check = getimagesize($_FILES["imageup"]["tmp_name"]);
if($check !== false) {
    echo "<li>File is an image of type - " . $check["mime"] . ".</li>";
    $uploadOk = 1;
} else {
    echo "<li>File is not an image.</li>";
    $uploadOk = 0;
}

$imageFileType = pathinfo($upload_file,PATHINFO_EXTENSION);
// Verify if the image file is an actual image or a fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imageup"]["tmp_name"]);
    if($check !== false) {
        echo "<li>File is an image of type - " . $check["mime"] . ".</li>";
        $uploadOk = 1;
    } else {
        echo "<li>File is not an image.</li>";
        $uploadOk = 0;
    }
}

// Verify if file already exists
if (file_exists($upload_file)) {
    echo "<li>The file already exists.</li>";
    $uploadOk = 0;
}
// // Verify the file size
// if ($_FILES["imageup"]["size"] > 500000) {
//     echo "<li>The file is too large.</li>";
//     $uploadOk = 0;
// }
// Verify certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "<li>Only jpg, png, and jpeg files are allowed for the upload.</li>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<li>The file was not uploaded.</li>";
} else { // upload file
    if (move_uploaded_file($_FILES["imageup"]["tmp_name"], $upload_file)) {
        echo "<li>The file ". basename( $_FILES["imageup"]["name"]). " has been uploaded.</li>";
    } else {
        echo "<li>Error uploading your file.</li>";
    }
}

$image_url = substr($upload_file,3); 

// if(file_exists($upload_file)){
//     echo "image already exists";
// }else{
//     $check = getimagesize($_FILES["imageup"]["tmp_name"]);
//     if($check !== false){
//         move_uploaded_file($_FILES["imageup"]["tmp_name"], $upload_file);
//         echo "successfully uploaded image";
//     }else{
//         echo "invalid image file";
//     }
// }

//echo "success";
$stmt->execute();

$conn->close();

//insert to database
echo "Successfully added artist";
?>
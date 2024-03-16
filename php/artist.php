<?php
class Artist implements JsonSerializable{
    private $name;
    private $latestAlbum;
    //formation year
    private $year;
    //group or solo artist
    private $isGroup;
    private $genre;
    //image of latest album
    private $image;

    public function __construct() {
        $this->name = 'band_artist_name';
        $this->latestAlbum = 'album_name';
        $this->year = 0;
        $this->isGroup = false;
        $this ->genre = 'none';
        $this ->image = "image_url";
       }

    public function setBandName($n){
        $this->name = $n;
    }
    public function getBandName(){
        return $this->name;
    }
    public function setAlbumName($n){
        $this->latestAlbum = $n;
    }
    public function getAlbumName(){
        return $this->latestAlbum;
    }
    public function setYear($n){
        $this->year = $n;
    }
    public function getYear(){
        return $this->year;
    }
    public function setIsGroup($n){
        $this->isGroup = $n;
    }
    public function getIsGroup(){
        return $this->isGroup;
    }
    public function setGenre($n){
        $this->genre = $n;
    }
    public function getGenre(){
        return $this->genre;
    }
    public function setImage($n){
        $this->image=$n;
    }
    public function getImage($n){
        return $this->image;
    }
    

    public function jsonSerialize():mixed {
        return [
            'name' => $this->name,
			'latestAlbum' => $this->latestAlbum,
            'year' => $this->year,
			'isGroup' => $this->isGroup,
			'genre' => $this->genre,
 			'image' => $this->image
            ];
    }
    public function JSON_to_object($json){
        $s1=$json['name'];
		$s2=$json['latestAlbum'];
		$s3=$json['year'];
		$s4=$json['isGroup'];
		$s5=$json['genre'];
		$s6=$json['image'];

        $this->setBandName($s1);
        $this->setAlbumName($s2);
        $this->setYear($s3);
        $this->setIsGroup($s4);
        $this->setGenre($s5);
        $this->setImage($s6);
    }
    public function getString() {
		return json_encode($this);
	}
}

?>
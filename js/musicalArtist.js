//step 1
class musicalArtist {
    name = 'band/artist name'
    latestAlbum = 'album name'
    //formation year
    year = 0
    //group or solo artist
    isGroup = false
    genre = 'none'
    //image of latest album
    image = ""

    constructor(name, latestAlbum, year, group, genre, image="") {
        this.name = name
        this.latestAlbum = latestAlbum
        this.year = year
        this.isGroup = group
        this.genre = genre
        this.image = image
    }
}
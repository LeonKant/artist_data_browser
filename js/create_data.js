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
    image = null

    constructor(name, latestAlbum, year, group, genre, image) {
        this.name = name
        this.latestAlbum = latestAlbum
        this.year = year
        this.isGroup = group
        this.genre = genre
        this.image = image
    }
}

//step 2
slowpulp = new musicalArtist('Slow Pulp')
slowpulp.latestAlbum = 'Yard'
slowpulp.year = 2015
slowpulp.isGroup = true
slowpulp.genre = 'Indie Rock'
slowpulp.image = 'https://static.stereogum.com/uploads/2023/09/slow-pulp-yard-1695054436-870x870.jpeg'

let nailsImage = 'https://i.scdn.co/image/ab67616d0000b273faaa5d735f163cacab8aac77'
let nails = new musicalArtist('Nails', 'You Will Never Be One of Us', 2009, true, 'Death Metal', nailsImage)

let yeatImage = 'https://steamuserimages-a.akamaihd.net/ugc/2062125708694526580/8882060B6EE3085063F1DF1DC6DDCCAAE7F05264/?imw=512&&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false'
let yeat = new musicalArtist('Yeat', 'AftërLyfe', 2015, false, 'Rap', yeatImage)

let gecs100Image = 'https://upload.wikimedia.org/wikipedia/en/8/8d/10000_gecs_album_cover.jpg'
let gecs100 = new musicalArtist('100 gecs', '10,000 gecs', 2015, true, 'Hyperpop', gecs100Image)

let panteraImage = 'https://m.media-amazon.com/images/I/81lOHb0SANL._UF1000,1000_QL80_.jpg'
let pantera = new musicalArtist('Pantera', 'Reinventing the Steel', 1981, true, 'Metal', panteraImage)
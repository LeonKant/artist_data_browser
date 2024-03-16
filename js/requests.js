function dataRequest() {
    const httpRequest = new XMLHttpRequest();
    // let url = 'artists.json'
    let url = 'php/getobject_artist.php?index=' + index
    //Specifies the request
    httpRequest.onreadystatechange = () => {
        if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
            let stringData = httpRequest.responseText
            console.log(stringData)
            let responseData = JSON.parse(stringData)
            // currentData = JSON.parse(httpRequest.responseText)
            currentData = JSON.parse(responseData["artist"])
            numArtists = JSON.parse(responseData["numArtists"])
            displayJSONObject()
            //document.getElementById('JSON_string_div').innerHTML = stringData
        }
    }
    httpRequest.open('GET', url, true)
    httpRequest.send()
}

function dataRequestAll(ind,sortName="") {
    const httpRequest = new XMLHttpRequest();
    // let url = 'artists.json'
    let url = 'php/get_all_artists.php'
    //Specifies the request
    httpRequest.onreadystatechange = () => {
        if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
            let stringData = httpRequest.responseText
            console.log(stringData)
            let data = JSON.parse(stringData)
            // currentData = JSON.parse(httpRequest.responseText)

            artists = data.map(a=>new musicalArtist(a["band_name"],a["latest_album_name"],a["year"],a["is_group"],a["genre"],a["image_url"]))
            numArtists = artists.length

            if (alphaSorted){
                artists = artists.sort((a,b)=>{
                    if (a["name"].toLowerCase() < b["name"].toLowerCase()){
                        return -1
                    }
                })
            }

            //last element
            if (ind == -1){
                index = numArtists - 1
            }
            //handle deleting element
            else if(ind == -2){
                decrementCount()
            }
            else if(ind == -3 && sortName != ""){   
                index = artists.findIndex((a)=>a["name"]==sortName)
            }
            //index provided as input
            else{
                index = ind
            }
            displayJSONObject(index)
            //document.getElementById('JSON_string_div').innerHTML = stringData
        }
    }
    httpRequest.open('GET', url, true)
    httpRequest.send()
}

function deleteElementRequest() {
    const httpRequest = new XMLHttpRequest();
    // let url = 'artists.json'
    let url = 'php/delete_element.php?index='+(index+1)
    //Specifies the request
    httpRequest.onreadystatechange = () => {
        if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
            let stringData = httpRequest.responseText
            console.log(stringData)
            dataRequestAll(-2)

            //document.getElementById('JSON_string_div').innerHTML = stringData
        }
    }
    httpRequest.open('GET', url, true)
    httpRequest.send()
}

// send allData to server to save to database
function saveAllRequest(){
    const httpRequest = new XMLHttpRequest()
    let jsonString = JSON.stringify(allData[0])
    let url = "php/save_all.php"
    console.log(url)

    httpRequest.onreadystatechange = () => {
        try{
            if(httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200){
                let stringData = httpRequest.responseText;
                console.log(stringData)
            }
        }
        catch(e){
            console.log(e)
        }
    }
    httpRequest.open('post',url,true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('data=' + jsonString)
}

function insertNewElementRequest(){
    const httpRequest = new XMLHttpRequest()
    let url = "php/insert_new.php"
    // let jsonString = JSON.stringify(newElementJSON)
    var formData = new FormData(document.getElementById('artist_form'));

    // console.log(jsonString)

    httpRequest.onreadystatechange = () =>{
        try{
            if(httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200){
                let stringData = httpRequest.responseText
                console.log('string data: ' + stringData)
                if(alphaSorted){
                    dataRequestAll(-3,formData.get("name_text"))
                }else{
                    dataRequestAll(-1)
                }
                
            }
        }
        catch(e){
            console.log(e)
        }
    }
    httpRequest.open('post',url,true)
    httpRequest.send(formData)
}

function editElementRequest(jsonString){
    const httpRequest = new XMLHttpRequest()
    let url = "php/update_element.php"

    httpRequest.onreadystatechange = () =>{
        try{
            if(httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200){
                let stringData = httpRequest.responseText
                console.log('string data: ' + stringData)
                dataRequestAll(index)
            }
        }
        catch(e){
            console.log(e)
        }
    }
    httpRequest.open('post',url,true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('data=' + jsonString +'&index=' + index)
}
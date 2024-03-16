var index = 0
var display = false
var insertingNew = false
var numArtists

// true: sorted in alpha order 
// false: sorted by index
var alphaSorted = false
var sortInd
//contains all artists
var artists
var readOnly = true

function initializeDataBrowser(){
    dataRequestAll(0)
    // getNumRowsRequest()
}
function sortAlpha(){
    if(display && !alphaSorted){
        alphaSorted = true
        document.getElementById("delete_button").setAttribute("disabled","true")
        artists = artists.sort((a,b)=>{
            if (a["name"].toLowerCase() < b["name"].toLowerCase()){
                return -1
            }
        })
        index=0
        displayJSONObject(index)
    }
}
function sortDefault(){
    if(display && alphaSorted){
        index = 0
        document.getElementById("delete_button").removeAttribute("disabled")
        alphaSorted = false
        dataRequestAll(0)
    }
}
function getNextArtist(){
    if(display){
        incrementCount()
        displayJSONObject(index)  
    }
}
function getPrevArtist(){
    if(display){
        decrementCount()
        displayJSONObject(index)
    }
}
function getFirstArtist(){
    if(display){
        index = 0
        displayJSONObject(index)
    }
}
function getLastArtist(){
    if(display){
        index = artists.length-1
        displayJSONObject(index)
    }
}
function incrementCount(){
    if(!display){
        return
    }
    if (index == numArtists-1){
        index = 0
    }
    else{
        index++
    }
}
function decrementCount(){
    if(!display){
        return
    }
    if (index == 0){
        index = numArtists-1
    }
    else{
        index--
    }
}

//saves changes in 'allData'
function saveChanges(){
    if(!display){
        return
    }
    allData[index]["name"] =document.getElementById('name_text').value
    allData[index]["latestAlbum"]=document.getElementById('album_text').value
    allData[index]["year"]=document.getElementById('year_text').value
    allData[index]["isGroup"]=document.getElementById('group_text').value
    allData[index]["genre"]=document.getElementById('genre_text').value
    
    toggleEditText();
}
function toggleEditText(){
    if(display||insertingNew){
        let inputs = document.getElementsByClassName('text_display')

        for(let i = 0;i<inputs.length;++i){
            if(readOnly){
                inputs[i].removeAttribute('readonly')
            }
            else{
                inputs[i].setAttribute('readonly',true)
            }
            
        }
        readOnly = !readOnly
    
    }
}

function showElementInd(){
    document.getElementById('ind_display').textContent = index+1 + "/"+ numArtists
}

function displayJSONObject(ind){
    display = true

    showElementInd()
    document.getElementById('name_text').value=   artists[ind]["name"]
    document.getElementById('album_text').value = artists[ind]["latestAlbum"]
    document.getElementById('year_text').value=   artists[ind]["year"]
    document.getElementById('group_text').value = artists[ind]["isGroup"]
    document.getElementById('genre_text').value = artists[ind]["genre"]
    document.getElementById('artist_image').setAttribute("src", artists[ind]["image"])
}
function clearDisplay(){
    display = false
    index = 0

    document.getElementById('ind_display').textContent = ""
    document.getElementById('name_text').value=  ""
    document.getElementById('album_text').value =""
    document.getElementById('year_text').value=  ""
    document.getElementById('group_text').value =""
    document.getElementById('genre_text').value =""
    document.getElementById('artist_image').setAttribute("src", "")
}
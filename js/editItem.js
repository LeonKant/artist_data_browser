function toggleEditElement(){
    if(display){
        toggleEditText()
        document.getElementById("buttons_div").style.display="none"
        document.getElementById("edit_buttons_div").style.display="block"
    }
}
function cancelEditElement(){
    toggleEditText()
    document.getElementById("buttons_div").style.display="block"
    document.getElementById("edit_buttons_div").style.display="none"
    displayJSONObject(index)
}
function finishEditElement(){
    toggleEditText()
    document.getElementById("buttons_div").style.display="block"
    document.getElementById("edit_buttons_div").style.display="none"
}
function saveEditElement(){
    let artist = new musicalArtist(
        document.getElementById('name_text').value,
        document.getElementById('album_text').value,
        document.getElementById('year_text').value,
        document.getElementById('group_text').value,
        document.getElementById('genre_text').value,
    )
    editElementRequest(JSON.stringify(artist))
    finishEditElement()
}
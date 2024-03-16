function createNewElement(){
    clearDisplay();
    insertingNew = true
    toggleEditText()
    document.getElementById("buttons_div").style.display="none"
    document.getElementById("insert_buttons_div").style.display="block"
    document.getElementById("imageup").removeAttribute('hidden')
}
function cancelInsertNewElement(){
    toggleEditText()
    insertingNew = false
    document.getElementById("buttons_div").style.display="block"
    document.getElementById("insert_buttons_div").style.display="none"
    document.getElementById("imageup").setAttribute('hidden','true')
    displayJSONObject(index)
    // getNumRowsRequest()
}
function InsertNewElement(){
    insertNewElementRequest()
    cancelInsertNewElement()
    // if(!alpha)
    // dataRequestAll(-1)

}
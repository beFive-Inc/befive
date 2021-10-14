require('./bootstrap');

const inputSearch = document.querySelector("#search")
let valueSearchPlayer = ""

inputSearch.addEventListener("keyup", (e)=>{
    console.log(e.key)
    valueSearchPlayer += e.key;
})


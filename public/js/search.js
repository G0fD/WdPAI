const searchInput = document.querySelector('input[name="search"]');
const searchResult = document.querySelector('.search-result');
const searchHideNSeek = document.querySelector('.hide-n-seek');

searchInput.addEventListener("input", function() {
    if (this.value === "") {
        searchHideNSeek.style.display = "none";
    } else {
        searchHideNSeek.style.display = "inline-block";
        searchHideNSeek.style.justifySelf = "center";
    }
});

searchInput.addEventListener("keyup", function (event){
    if(event.key === "Enter"){
        event.preventDefault();
        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response){
            return response.json();
        }).then(function (songs){
            searchResult.innerHTML = "";
            loadSongs(songs)
        });
    }
});

document.addEventListener("DOMContentLoaded", openSelect);

function loadSongs(songs){
    songs.forEach(song => {
        createSong(song);
    });
}

function createSong(song){
    const template = document.querySelector("#search-template");
    const clone = template.content.cloneNode(true);
    const title = clone.querySelector("option");
    title.value = song.id;
    title.textContent =song.title+" "+song.author;
    searchResult.appendChild(clone);
}

function openSelect() {
    const select = document.querySelector('.search-result');
    select.size = select.options.length;
}

document.addEventListener("click", function(event) {
    if (!event.target.closest(".hide-n-seek")) {
        searchHideNSeek.style.display = "none";
        document.querySelector(".search-result").selectedIndex = -1;
    }
});

document.addEventListener("click", function(event) {
    if (searchInput.value !== "" && event.target.closest("#inpt")){
        searchHideNSeek.style.display = "inline-block";
    }
});
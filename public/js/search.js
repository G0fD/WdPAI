const searchInput = document.querySelector('input[name="search"]');
const searchResult = document.querySelector('.search-result');
const searchHideNSeek = document.querySelector('.hide-n-seek');
const main = document.querySelector("main");
const rating = document.querySelector('#myselect');

searchResult.addEventListener("change", function (event){
    event.preventDefault();
    const data = {display: this.value};
    fetch("/display",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response){
        return response.json();
    }).then(function (song){
        main.innerHTML = "";
        searchHideNSeek.style.display = "none";
        loadSingle(song)
    });
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

searchInput.addEventListener("input", function() {
    if (this.value === "") {
        searchHideNSeek.style.display = "none";
    } else {
        searchHideNSeek.style.display = "inline-block";
        searchHideNSeek.style.justifySelf = "center";
    }
});

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
    rating.selectedIndex = -1;
    const select = document.querySelector('.search-result');
    select.size = select.options.length;
}

function loadSingle(song){
   const template = document.querySelector("#song-template");
   const clone = template.content.cloneNode(true);
   const title = clone.querySelector("div.title > p");
   title.innerHTML = song.author+" - "+song.title;
   const album = clone.querySelector("div.album > p");
   album.innerHTML = "from "+song.album+" album";
   const image = clone.querySelector("img");
   image.src = `/public/uploads/${song.filename}`;
   const player = clone.querySelector("div.player > a");
   let str = song.author+" "+song.title;
   str = str.replace(" ", "+");
   player.href = "https://www.youtube.com/results?search_query="+str;
   const ratingclone = clone.querySelector("#myselect-1");
   ratingclone.selectedIndex = -1;
   loadGenres(clone, song.id);
   loadProviders(clone, song.id);
   main.appendChild(clone);
    document.cookie = "id_song=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "id_song="+song.id+"; expires=" + (new Date(Date.now() + 900000)).toUTCString() + "; path=/";
}

function loadGenres(clone, id){
    const data = {getGenres: id};
    fetch("/getGenres",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response){
        return response.json();
    }).then(function (genres){
        genres.forEach(genre =>{
           loadGenre(genre);
        });
    });
}

function loadGenre(genre){
    const list = document.querySelector("#ul-template-1");
    const generate = document.createElement('li');
    generate.innerText = genre.name;
    list.appendChild(generate);
}

function loadProviders(clone, id){
    const data = {getProviders: id};
    fetch("/getProviders",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response){
        return response.json();
    }).then(function (providers){
        providers.forEach(provider =>{
            loadProvider(provider);
        });
    });
}

function loadProvider(provider){
    const list = document.querySelector("#ul-template-2");
    const generate = document.createElement('li');
    generate.innerText = provider.name;
    list.appendChild(generate);
}
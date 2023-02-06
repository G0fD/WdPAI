const logoutElement = document.querySelector("#logout");

logoutElement.addEventListener("click", function (){
    document.cookie = 'id_user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
    document.cookie = 'id_song=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
    location.reload();
});
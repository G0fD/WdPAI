<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
    <link rel="icon" type="image/x-icon" href="public/img/favicon.svg">
    <title>My Profile</title>
</head>
<body>
    <div class="container">
        <nav>
            <img class ="small-logo" src="public/img/shipify.svg" alt="shipify">
            <ul>
                <li>
                    <a href="#" class="button">Personal information</a>
                </li>
                <li>
                    <a href="#" class="button">Rated songs</a>
                </li>
                <li>
                    <a href="#" class="button">My matches</a>
                </li>
                <li>
                    <a href="#" class="button">Admin - Add Song</a>
                </li>
                <li>
                    <p>SHIPify made by Jakub Jajkowicz</p>
                    <p>All rights reserved etc.</p>
                </li>    
            </ul>
        </nav>
        <main>
            <h1>UPLOAD</h1>
            <form action="addSong" method="POST" ENCTYPE="multipart/form-data">
                <section class="insert">
                <div class="messages">
                <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
                </div>
                <input type="text" name="title" placeholder="Song title">
                <input type="text" name="author" placeholder="Author name">
                <input type="text" name="album" placeholder="Album name">
                <input type="file" name="file">
                </section>
                <section class="select">

                <select name="genres[]" id="genres" multiple="multiple">
                    <option value="1">Ania</option>
                    <option value="2">Ma</option>
                    <option value="3">Kota</option>
                </select>

                <select name="where[]" id="where" multiple="multiple">
                    <option value="YouTube Music">YouTube Music</option>
                    <option value="Spotify">Spotify</option>
                    <option value="Tidal">Tidal</option>
                    <option value="SoundCloud">SoundCloud</option>
                </select>

                </section>
                <button type="submit">SEND</button>
            </form>
        </main>
    </div>
</body>
</html>
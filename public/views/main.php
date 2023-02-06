<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mainsite.css">
    <link rel="icon" type="image/x-icon" href="public/img/favicon.svg">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>Main Page</title>
</head>
<body>
<?php
if (!isset($_COOKIE["id_user"])){
    header("Location:welcome");
}
?>
    <div class="base-container">
        <main>
            <section class="left">
                <div class="title">
                    <p><?=$song->getAuthor()." - ".$song->getTitle()?></p>
                </div>
                <div class="album">
                    <p><?='from '.$song->getAlbum().' album'?></p>
                </div>
                <div class="photo">
                    <img src="public/uploads/<?=$song->getImage() ?>" alt="cover">
                </div>
                <div class="player">
                    <a href="https://www.youtube.com/results?search_query=<?=str_replace(' ', '+' ,$song->getAuthor().' '.$song->getTitle())?>" target="_blank" rel="noopener noreferrer">Check on YouTube</a>
                </div>
            </section>

            <section class="right">
                <div class="genres">
                   <p>Main genres:</p>
                   <ul>
                    <?php
                    foreach ($song->getGenres() as $genre){
                        echo "<li>".$genre['name']."</li>";
                    }
                    ?>
                   </ul>
                </div>
                <div class="where">
                    <p>Available on:</p>
                    <ul>
                    <?php
                    foreach ($song->getWhere() as $where){
                        echo "<li>".$where['name']."</li>";
                    }
                    ?>
                    </ul>
                </div>
                <div class="rating">
                    <p>Did you like it?</p>
                    <form action="rate" method="POST">
                        <select name="ratingselect" id="myselect" onchange="this.form.submit()">
                            <option value="1">I hate it</option>
                            <option value="2">I don't like it</option>
                            <option value="3">Not bad, not good</option>
                            <option value="4">I like it</option>
                            <option value="5">I love it</option>
                        </select>
                    </form>
                </div>
            </section>
        </main>
        <footer>
            <div class="small-logo">
                <img onclick="window.location='#';" src="public/img/shipify.svg" alt="shipify">
            </div>
            <div class="search-bar">
                    <input id='inpt' type="text" name="search" placeholder="search for your fav music" autocomplete="off">
                    <section class="hide-n-seek">
                        <select class="search-result">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </section>
            </div>
            <div class="profile-link" >
                <p onclick="window.location='profile';" >profile</p>
                <img src="public/img/undraw_pic_profile_re_lxn6 1.svg" alt="profile" onclick="window.location='profile';">
            </div>
        </footer>
    </div>
</body>
</html>


<template id="search-template">
    <option value=""></option>
</template>

<template id="song-template">
    <section class="left">
        <div class="title">
            <p></p>
        </div>
        <div class="album">
            <p></p>
        </div>
        <div class="photo">
            <img src="" alt="cover">
        </div>
        <div class="player">
            <a href="" target="_blank" rel="noopener noreferrer">Check on YouTube</a>
        </div>
    </section>

    <section class="right">
        <div class="genres">
            <p>Main genres:</p>
            <ul id="ul-template-1">
                <li></li>
            </ul>
        </div>
        <div class="where">
            <p>Availible on:</p>
            <ul id="ul-template-2">
                <li></li>
            </ul>
        </div>
        <div class="rating">
            <p>Did you like it?</p>
            <form action="rate" method="POST">
                <select name="ratingselect" id="myselect-1" onchange="this.form.submit()">
                    <option value="1">I hate it</option>
                    <option value="2">I don't like it</option>
                    <option value="3">Not bad, not good</option>
                    <option value="4">I like it</option>
                    <option value="5">I love it</option>
                </select>
            </form>
        </div>
    </section>
</template>
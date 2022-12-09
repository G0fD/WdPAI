<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mainsite.css">
    <link rel="icon" type="image/x-icon" href="public/img/favicon.svg">
    <title>Main Page</title>
</head>
<body>
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
                    <a href="https://www.youtube.com/watch?v=OXsbpefY_xc" target="_blank" rel="noopener noreferrer">Watch on YouTube</a>
                </div>
            </section>

            <section class="right">
                <div class="genres">
                   <p>Main genres:</p>
                   <ul>
                    <?php
                    foreach ($song->getGenres() as $genre){
                        echo "<li>".$genre."</li>";
                    }
                    ?>
                   </ul>
                </div>
                <div class="where">
                    <p>Availible on:</p>
                    <ul>
                    <?php
                    foreach ($song->getGenres() as $genre){
                        echo "<li>".$genre."</li>";
                    }
                    ?>
                    </ul>
                </div>
                <div class="rating">
                    <p>Did you like it?</p>
                    <form action="" method="POST">
                        <select name="ratingselect" id="myselect" onchange="this.form.submit()">
                            <option value="1">I hate it</option>
                            <option value="2">I don't like it</option>
                            <option selected="selected" value="3">I'm neutral about it</option>
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
                <form action="">
                    <input type="text" name="search" placeholder="search for your fav music">
                </form>
            </div>
            <div class="profile-link" >
                <p onclick="window.location='login.html';" >profile</p>
                <img src="public/img/undraw_pic_profile_re_lxn6 1.svg" alt="profile" onclick="window.location='login.html';">
            </div>
        </footer>
    </div>
</body>
</html>
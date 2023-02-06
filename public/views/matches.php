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

<?php
if(!isset($_COOKIE["id_user"])){
    header("Location: welcome");
}
?>

    <div class="container">
        <nav>
            <img class ="small-logo" src="public/img/shipify.svg" alt="shipify" onclick="window.location='main';">
            <ul>
                <li>
                    <a href="profile" class="button">Personal information</a>
                </li>
                <li>
                    <a href="#" class="button">Rated songs</a>
                </li>
                <li>
                    <a href="#" class="button">My matches</a>
                </li>
                <li>
                    <?php if ($isAdmin) echo '<a href="addSong" class="button">Admin - Add Song</a>';?>
                </li>
                <li>
                    <p>SHIPify made by Jakub Jajkowicz</p>
                    <p>All rights reserved etc.</p>
                </li>    
            </ul>
        </nav>
        <main>
            <?php
            if (isset($users)){
                echo '<div class="matches">';
                foreach ($users as $user){
                    $details = $user->getDetails();
                    echo "<p><b>".$details['name']." ".$details['surname']."</b> contact here: <i>".$details['email']."</i></p>";
                }
                echo '</div>';
            }
            ?>
        </main>
    </div>
</body>
</html>
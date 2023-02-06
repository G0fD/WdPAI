<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('welcome', 'DefaultController');

Routing::post('main', 'SongController');
Routing::post('addSong', 'SongController');
Routing::post('search', 'SongController');
Routing::post('display', 'SongController');
Routing::post('getGenres', 'SongController');
Routing::post('getProviders', 'SongController');

Routing::get('matches', 'SecurityController');

Routing::post('rate', 'SecurityController');
Routing::post('profile', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');

Routing::run($path);
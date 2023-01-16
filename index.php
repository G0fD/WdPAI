<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('login', 'DefaultController');

Routing::get('profile', 'DefaultController');
Routing::get('signup', 'DefaultController');

Routing::get('main', 'SongController');

Routing::post('login', 'SecurityController');
Routing::post('addSong', 'SongController');
Routing::post('search', 'SongController');

Routing::run($path);
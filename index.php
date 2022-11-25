<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('login', 'DefaultController');

Routing::get('main', 'DefaultController');
Routing::get('profile', 'DefaultController');
Routing::get('signup', 'DefaultController');

Routing::run($path);

?>
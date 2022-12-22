<?php

namespace repository;
require_once __DIR__.'/../../Database.php';

class Repository
{
    protected $database;

    public function __construct() {
        $this->database = \Database::getInstance();
    }

}
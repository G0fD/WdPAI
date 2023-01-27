<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function welcome(){
        $this->render('welcome');
    }

    public function login(){
        $this->render('login');
    }
}
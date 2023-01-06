<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function index(){
        $this->render('login');
    }

    public function profile(){
        $this->render('profile');
    }

    public function signup(){
        $this->render('signup');
    }
}
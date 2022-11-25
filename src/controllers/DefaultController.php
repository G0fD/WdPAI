<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function index()
    {
        $this->render('index');
    }

    public function login(){
        $this->render('login');
    }

    public function main(){
        $this->render('main');
    }

    public function profile(){
        $this->render('profile');
    }

    public function signup(){
        $this->render('signup');
    }
}
?>
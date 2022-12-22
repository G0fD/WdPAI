<?php

use models\Song;
use repository\UserRepository;

require_once __DIR__.'/../repository/UserRepository.php';
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){

        $userRepository = new UserRepository();

        if (!$this->isPost()){
            return $this->render('login');
        }

        $login = $_POST["login"];
        $password = $_POST["password"];

        $user = $userRepository->getUserByLogin($login);

        if (!$user){
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if($user->getUsername() !== $login){
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if($user->getPassword() !== $password){
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        //tmp song
        $song = new Song('Title','Author','album','gifnakirihello.gif',[1,2],[4,5]);

        return $this->render('main',['messages'=>" ",'song'=>$song]);
        //$url = "http://$_SERVER[HTTP_HOST]";
        //header("Location: {$url}/main");
    }
}
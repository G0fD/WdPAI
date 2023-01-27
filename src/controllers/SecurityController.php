<?php

use models\Song;
use models\User;
use repository\UserRepository;

require_once __DIR__.'/../repository/UserRepository.php';
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){

        $userRepository = new UserRepository();

        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
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

        setcookie("id_user", $user->getId(), time()+30, '/');
    }

    public function profile(){

        if (isset($_COOKIE["id_user"])){
            $userRepository = new UserRepository();
            return $this->render('profile', ['messages'=> " ", 'isAdmin'=>$userRepository->isAdmin($_COOKIE["id_user"])]);
        }
        return $this->render('login', ['messages'=> ['Session expired!']]);
    }

    public function register(){

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('signup');
        }

        $userData = [
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'email' => $_POST['email'],
            'password_hash' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'username' => $_POST['username'],
            'lookingfor' => $_POST['lookingfor'],
            'sex' => $_POST['sex'],
        ];

        $user = $userRepository->addUser($userData);

        setcookie("id_user", $user->getId(), time()+10, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }
}
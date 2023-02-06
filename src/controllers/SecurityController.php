<?php

use models\Song;
use models\User;
use repository\UserRepository;

require_once __DIR__.'/../repository/UserRepository.php';
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login(){

        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
        }

        $login = $_POST["login"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUserByLogin($login);

        if (!$user){
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if($user->getUsername() !== $login){
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if(!password_verify($password, $user->getPassword())){
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        else{
            setcookie("id_user", $user->getId(), time()+900, '/');
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }

    public function profile(){

        if (isset($_COOKIE["id_user"])){
            return $this->render('profile', ['messages'=> " ", 'isAdmin'=>$this->userRepository->isAdmin($_COOKIE["id_user"])]);
        }
        return $this->render('login', ['messages'=> ['Session expired!']]);
    }

    public function register(){

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

        $user = $this->userRepository->addUser($userData);

        setcookie("id_user", $user->getId(), time()+30, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }



    public function rate(){
        if (!$this->isPost() || !isset($_COOKIE["id_user"]) || !isset($_COOKIE["id_song"])){
            return $this->render('main');
        }
        $id_user = $_COOKIE["id_user"];
        $id_song = $_COOKIE["id_song"];
        $rating = $_POST["ratingselect"];

        $this->userRepository->addRating($id_user, $id_song, $rating);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }

    public function matches(){
        if (!$this->isGet() || !isset($_COOKIE["id_user"]) || !isset($_COOKIE["id_song"])){
            return $this->render('matches');
        }
        $id_user = $_COOKIE["id_user"];
        $users = [];
        foreach ($this->userRepository->tryMatch($id_user) as $match){
            $users[] = $this->userRepository->getUserById($match);
        }
        return $this->render('matches', ['messages'=> " ", 'isAdmin'=>$this->userRepository->isAdmin($_COOKIE["id_user"]), 'users'=>$users]);
    }
}
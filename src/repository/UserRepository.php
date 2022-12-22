<?php

namespace repository;

use models\User;
use PDO;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUserByEmail(string $email):?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users WHERE email=:email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false){
            return null;
        }

        return new User(
            $user['id'],
            $user['username'],
            $user['password']
        );
    }

    public function getUserByLogin(string $login):?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users WHERE username=:login
        ');
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false){
            return null;
        }

        return new User(
            $user['id'],
            $user['username'],
            $user['password']
        );
    }

}
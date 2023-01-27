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

    public function isAdmin(int $id):bool
    {
        $stmt = $this->database->connect()->prepare('
        SELECT roles.role FROM roles INNER JOIN users ON users.id_role = roles.id WHERE users.id=:id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() === "admin";
    }

    public function addUser(array $values): ?User
    {
       $name = $values['name'];
        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO user_details (name, surname, gender, interested_in) VALUES (?,?,?,?)
        ');
        try{
            $dbh->beginTransaction();
            $stmt->execute([
            //TODO
            ]);
            $dbh->commit();
            $song_id = $dbh->lastInsertId();
        }catch (\PDOException $exception){
            die("Exception song ".$exception->getMessage());
        }
        return null;
    }

    private function addDetails(array $values):int{
        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO user_details (name, surname, gender, interested_in) VALUES (?,?,?,?)
        ');

        try{
            $dbh->beginTransaction();
            $stmt->execute([
                $values['name'],
                $values['surname'],
                $values['sex'],
                $values['lookingfor']
            ]);
            $dbh->commit();
            $details_id = $dbh->lastInsertId();
        }catch (\PDOException $exception){
            die("Exception song ".$exception->getMessage());
        }
        return $details_id;
    }

}
<?php

namespace repository;

use models\User;
use PDO;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUserById(int $id):?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users WHERE id=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
        $id_details = $this->addDetails($values);

        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO users (id_role, id_user_details, email, username, password) VALUES (?,?,?,?,?)
        ');
        try{
            $dbh->beginTransaction();
            $stmt->execute([
                2,
                $id_details,
                $values['email'],
                $values['username'],
                $values['password_hash']
            ]);
            $dbh->commit();
        }catch (\PDOException $exception){
            die("Exception song ".$exception->getMessage());
        }
        return $this->getUserByLogin($values['username']);
    }

    public function addRating(int $user, int $song, int $grade){
        if (!$this->checkIfRated($user,$song)){
            $dbh = $this->database->connect();
            $stmt = $dbh->prepare('
            INSERT INTO liked_by (id_user, id_song, rating) VALUES (?,?,?)
            ');
            try{
                $dbh->beginTransaction();
                $stmt->execute([
                    $user,
                    $song,
                    $grade
                ]);
                $dbh->commit();
            }catch (\PDOException $exception){
                die("Exception song ".$exception->getMessage());
            }
        }else{
            $dbh = $this->database->connect();
            $stmt = $dbh->prepare('
            UPDATE liked_by SET rating = :rating WHERE id_song = :song AND id_user = :user
            ');
            $stmt->bindParam(':rating', $grade, PDO::PARAM_INT);
            $stmt->bindParam(':song', $song, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);
            try{
                $dbh->beginTransaction();
                $stmt->execute();
                $dbh->commit();
            }catch (\PDOException $exception){
                die("Exception song ".$exception->getMessage());
            }
        }
    }

    public function tryMatch(int $id_user):array
    {
        $result = [];
        $user_rated = $this->getRated($id_user);

        $all_ids = [];
        foreach ($this->getAllId() as $user){
            if ($user['id'] !== $id_user) $all_ids[] = $user['id'];
        }
        foreach ($all_ids as $single_id){
            if (array_intersect($this->getRated($single_id),$user_rated)) $result[] = $single_id;
        }
        return $result;
    }

    private function getRated(int $id){
        $stmt = $this->database->connect()->prepare('
        SELECT id_song, rating from liked_by where id_user = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getAllId(){
        $stmt = $this->database->connect()->prepare('
        SELECT id FROM users;
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function checkIfRated(int $user, int $song){
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM liked_by WHERE id_user=:id_user AND id_song=:id_song
        ');

        $stmt->bindParam(':id_user', $user, PDO::PARAM_INT);
        $stmt->bindParam(':id_song', $song, PDO::PARAM_INT);
        $stmt->execute();

        $tmp = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($tmp['rating'])) return true;
        return false;
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
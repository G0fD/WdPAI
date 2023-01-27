<?php

namespace repository;

use models\Song;
use PDO;

require_once 'Repository.php';
require_once __DIR__.'/../models/Song.php';

class SongRepository extends Repository
{
    public function getSong(int $id):?Song
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM songs where id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $song = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($song == false){
            return null;
        }

        return new Song(
            $song['title'],
            $song['author'],
            $song['album'],
            $song['filename'],
            $this->getGenres($song['id']),
            []
        );
    }

    public function getSongs():array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM songs
        ');
        $stmt->execute();
        $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($songs as $song){
            $result[] = new Song(
                $song['title'],
                $song['author'],
                $song['album'],
                $song['filename'],
                $this->getGenres($song['id']),
                ['Youtube',"Test"]
            );
        }
        return $result;
    }

    public function getSongByTitleAuthor(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM songs WHERE LOWER(title) LIKE :search OR LOWER(author) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSong(Song $song): void{

        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO songs (title, author, album, filename) VALUES (?,?,?,?)
        ');

        try{
            $dbh->beginTransaction();
            $stmt->execute([
                $song->getTitle(),
                $song->getAuthor(),
                $song->getAlbum(),
                $song->getImage()
            ]);
            $dbh->commit();
            $song_id = $dbh->lastInsertId();
        }catch (\PDOException $exception){
            die("Exception song ".$exception->getMessage());
        }

        foreach ($song->getGenres() as $genre){
            $stmt = $dbh->prepare('
            INSERT INTO song_genres (id_song, id_genre) VALUES (?,?)
            ');
            try {
                $dbh->beginTransaction();

                $stmt->execute([
                    $song_id,
                    $genre
                ]);

                $dbh->commit();
            }catch (\PDOException $exception){
                die("Exception genres ".$exception->getMessage());
            }
        }
    }

    public function getGenreByID(int $id):string{
        $stmt = $this->database->connect()->prepare('
        SELECT name FROM genres where id=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    private function getGenres(int $id):array
    {
        $stmt = $this->database->connect()->prepare('
        SELECT id_genre FROM song_genres where id_song = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

}
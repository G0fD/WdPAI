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

    private function getGenres(int $id):array
    {
        $stmt = $this->database->connect()->prepare('
        SELECT id_genre FROM song_genres where id_song = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $genres[] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $genres;
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
}
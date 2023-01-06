<?php

use models\Song;
use repository\SongRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/Song.php';
require_once __DIR__.'/../repository/SongRepository.php';

class SongController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $songRepository;

    public function __construct()
    {
        parent::__construct();
        $this->songRepository = new SongRepository();
    }

    public function main(){
        $songs = $this->songRepository->getSongs();
        $this->render('main', ['song'=>$songs[0], 'songs' => $songs]);
    }

    public function addSong(){

        if (!$this->isPost()){
            return $this->render('addsong');
        }

        if ($this->validate($_FILES['file']) && $this->isPost() && is_uploaded_file($_FILES['file']['tmp_name'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $song = new Song($_POST['title'],$_POST['author'],$_POST['album'],$_FILES['file']['name'],$_POST['genres'],$_POST['where']);
            $this->songRepository->addSong($song);

            return $this->render('main',['messages'=>$this->message,'song'=>$song]);
        }
        return $this->render('addsong', ['messages' => $this->message]);
    }

    private function validate(array $file):bool
    {
        if ($file['size']>self::MAX_FILE_SIZE ){
            $this->message[] = 'File is too large';
            return false;
        }
        if (isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)){

            $this->message[] = 'File type is not supported';
            return false;
        }
        return true;
    }
}
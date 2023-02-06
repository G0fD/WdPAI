<?php

use models\Song;
use repository\SongRepository;
use repository\UserRepository;

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
        setcookie("id_song", $songs[0]->getId(), time()+1800, '/');
        $this->render('main', ['song'=>$songs[0], 'songs' => $songs]);
    }

    public function addSong(){

        $userRepo = new UserRepository();

        if (isset($_COOKIE["id_user"])){
            if (!$userRepo->isAdmin($_COOKIE["id_user"])) return $this->render('profile');
        }
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

            $url = "http://$_SERVER[HTTP_HOST]/main";
            header("Location: {$url}");
        }
        return $this->render('addsong', ['messages' => $this->message]);
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($this->songRepository->getSongByTitleAuthor($decoded['search']));
        }
    }

    public function display(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($this->songRepository->getSongById($decoded['display']));
        }
    }
    //by song id
    public function getGenres(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($this->songRepository->getSongGenresById($decoded['getGenres']));
        }
    }
    //by song id
    public function getProviders(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($this->songRepository->getSongProvidersById($decoded['getProviders']));
        }
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
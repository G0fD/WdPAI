<?php

class Database
{
    private static $_instance;
    private $username;
    private $password;
    private $host;
    private $database;

    private function __construct()
    {
        $this->username = 'dbuser';
        $this->password = 'dbpwd';
        $this->host = 'db';
        $this->database = 'dbname';
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a database singleton.");
    }

    public static function getInstance():Database{
        if (!isset(self::$_instance)){
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function connect(){
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        }catch (PDOException $exception){
            die("Connection failed: ".$exception->getMessage());
        }
    }
}
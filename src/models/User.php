<?php

namespace models;

class User
{
    private $id;
    private $username;
    private $password;

    public function __construct(string $id, string $username, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername():string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }
}
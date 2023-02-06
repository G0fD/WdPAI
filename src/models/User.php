<?php

namespace models;

class User
{
    private $id;
    private $username;
    private $password;
    private $details= [];

    public function __construct(string $id, string $username, string $password, array $details = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->details = $details;
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

    public function getDetails(): ?array
    {
        return $this->details;
    }

    public function setDetails(?array $details): void
    {
        $this->details = $details;
    }
}
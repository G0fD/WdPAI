<?php

namespace models;

class Song
{
    private $title;
    private $author;
    private $album;
    private $image;
    private $genres = [];
    private $where = [];

    public function __construct($title, $author, $album, $image, array $genres, array $where)
    {
        $this->title = $title;
        $this->author = $author;
        $this->album = $album;
        $this->image = $image;
        $this->genres = $genres;
        $this->where = $where;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getAuthor():string
    {
        return $this->author;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getAlbum():string
    {
        return $this->album;
    }

    public function setAlbum(string $album)
    {
        $this->album = $album;
    }

    public function getImage():string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres)
    {
        $this->genres = $genres;
    }

    public function getWhere(): array
    {
        return $this->where;
    }

    public function setWhere(array $where)
    {
        $this->where = $where;
    }

}
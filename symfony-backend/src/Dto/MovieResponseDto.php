<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

class MovieResponseDto
{
    #[Groups(['movie'])]
    private $id;    

    #[Groups(['movie'])]
    private $title;

    #[Groups(['movie'])]
    private $genre;

    #[Groups(['movie'])]
    private $length;

    #[Groups(['movie'])]
    private $releaseYear;

    public function __construct($id, $title, $genre, $length, $releaseYear)
    {
        $this->id = $id;        
        $this->title = $title;
        $this->genre = $genre;
        $this->length = $length;
        $this->releaseYear = $releaseYear;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of length
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of releaseYear
     */ 
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * Set the value of releaseYear
     *
     * @return  self
     */ 
    public function setReleaseYear($releaseYear)
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }
}
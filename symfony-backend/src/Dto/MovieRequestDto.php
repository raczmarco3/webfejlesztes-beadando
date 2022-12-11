<?php

namespace App\Dto;

class MovieRequestDto
{
    private $genreId;
    private $title;
    private $length;
    private $releaseYear;

    public function __construct($title, $genreId, $length, $releaseYear)
    {        
        $this->title = $title;
        $this->genreId = $genreId;
        $this->length = $length;
        $this->releaseYear = $releaseYear;
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
     * Get the value of genreId
     */ 
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * Set the value of genreId
     *
     * @return  self
     */ 
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;

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
<?php

namespace App\Dto;

class MovieActorResponseDto
{
    private $id;
    private $movie;
    private $actor;

    public function __construct($id, $movie, $actor)
    {
        $this->id = $id;
        $this->movie = $movie;
        $this->actor = $actor;
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
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of actor
     */ 
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Set the value of actor
     *
     * @return  self
     */ 
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }
}
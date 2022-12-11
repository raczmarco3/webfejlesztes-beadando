<?php

namespace App\Dto;

class MovieActorRequestDto
{
    private $movieId;
    private $actorId;

    public function __construct($movieId, $actorId)
    {
        $this->movieId = $movieId;
        $this->actorId = $actorId;
    }

    /**
     * Get the value of movieId
     */ 
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set the value of movieId
     *
     * @return  self
     */ 
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get the value of actorId
     */ 
    public function getActorId()
    {
        return $this->actorId;
    }

    /**
     * Set the value of actorId
     *
     * @return  self
     */ 
    public function setActorId($actorId)
    {
        $this->actorId = $actorId;

        return $this;
    }
}
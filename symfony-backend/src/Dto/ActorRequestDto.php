<?php

namespace App\Dto;

class ActorRequestDto
{
    private $name;    
    private $birthDate;    
    private $birthPlace;

    public function __construct($name, $birthDate, $birthPlace)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this->birthPlace = $birthPlace;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of birthDate
     */ 
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */ 
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of birthPlace
     */ 
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set the value of birthPlace
     *
     * @return  self
     */ 
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }
}
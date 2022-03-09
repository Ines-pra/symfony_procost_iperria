<?php

namespace App\Entity;

use DateTime;

class Employees 
{   
    private $id;

    private $firstname;

    private $lastname;

    private $email;

    private $job;

    private $dayCost;

    private $created_at;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        return $this->id = $id;
    }
    

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName(string $firstname)
    {
        return $this->firstname = $firstname;
    }

    
    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName(string $lastname)
    {
        return $this->lastname = $lastname;
    }

    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        return $this->email = $email;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob(string $job)
    {
        return $this->job = $job;
    }

    public function getDayCost()
    {
        return $this->dayCost;
    }

    public function setDayCost(int $dayCost)
    {
        return $this->dayCost = $dayCost;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        return $this->created_at = $created_at;
    }

}
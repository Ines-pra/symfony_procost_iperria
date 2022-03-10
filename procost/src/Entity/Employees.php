<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeesRepository")
 * @ORM\Table(name="sto_employees")
 */
class Employees 
{   

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length="255")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string",length="255")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string",length="255")
     */
    private $email;

    // /**
    //  * @ORM\Column(type="string",length="255")
    //  */
    /**
     * @ORM\ManyToOne(targetEntity=Job::class)
     * @ORM\JoinColumn(nullable=false, name="sto_job_id")
     */
    private $job;

    /**
     * @ORM\Column(type="integer")
     */
    private $dayCost;

    /**
     * @ORM\Column(type="datetime")
     */
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

    // public function getJob()
    // {
    //     return $this->job;
    // }

    // public function setJob(string $job)
    // {
    //     return $this->job = $job;
    // }

    public function getJob() : ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;
        return $this;
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
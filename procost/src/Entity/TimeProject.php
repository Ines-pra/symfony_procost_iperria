<?php

namespace App\Entity;

use DateTime;
use App\Entity\Employees;
use App\Entity\Project;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeProjectRepository")
 * @ORM\Table(name="sto_time_project")
 */
class TimeProject 
{   

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Employees::class)
     * @ORM\JoinColumn(nullable=false, name="sto_employee_id")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class)
     * @ORM\JoinColumn(nullable=false, name="sto_project_id")
     */
    private $project;

    /**
     * @ORM\Column(type="integer")
     */
    private $day;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

   

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        return $this->id = $id;
    }
    
    public function getEmployee() : ?Employees
    {
        return $this->employee;
    }

    public function setEmployee(?Employees $employee): self
    {
        $this->employee = $employee;
        return $this;
    }

    public function getProject() : ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay(int $day)
    {
        return $this->day = $day;
    }
    
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }



}
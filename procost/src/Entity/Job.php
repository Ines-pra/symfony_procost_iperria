<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @ORM\Table(name="sto_job")
 */
class Job 
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Employees", mappedBy="sto_job_id")
     */
    private $employees;


    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        return $this->id = $id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        return $this->name = $name;
    }

    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employees $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setJob($this);
        }
        return $this;
    }

}
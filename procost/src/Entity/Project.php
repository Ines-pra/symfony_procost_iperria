<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\Table(name="sto_project")
 */
class Project 
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
     * @ORM\Column(type="string",length="255")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $sales_price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deliver_date;

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
    
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        return $this->name = $name;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        return $this->description = $description;
    }

    public function getSalesPrice()
    {
        return $this->sales_price;
    }

    public function setSalesPrice(int $sales_price)
    {
        return $this->sales_price = $sales_price;
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

    public function getDeliverDate()
    {
        return $this->deliver_date;
    }

    public function setDeliverDate(?DateTime $deliver_date)
    {
        return $this->deliver_date = $deliver_date;
    }

}
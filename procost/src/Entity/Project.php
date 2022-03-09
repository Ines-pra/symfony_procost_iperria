<?php

namespace App\Entity;

use DateTime;

class Project 
{   

    private $id;

    private $name;

    private $description;

    private $sales_price;

    private $created_at;

    private $deliver_date;

    public function __construct()
    {
        $this->created_at = new \DateTime();
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

    public function getDeliverDate(): ?\DateTime
    {
        return $this->deliver_date;
    }

    public function setDeliverDate(DateTime $deliver_date)
    {
        return $this->deliver_date = $deliver_date;
    }

}
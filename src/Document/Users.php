<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
class Users
{
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'string')]
    protected string $firstname;

    #[MongoDB\Field(type: 'string')]
    protected string $lastname;

    #[MongoDB\Field(type: 'string')]
    protected string $city;

    #[MongoDB\Field(type: 'string')]
    protected string $address;


    public function getId(): string
    {
        return $this->id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getFirstName(): string
    {
        return $this->firstname;
    }

    public function getLastName(): string
    {
        return $this->lastname;
    }

    public function setCity(string $city): Users
    {
        $this->city = $city;

        return $this;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): Users
    {
        $this->address = $address;

        return $this;
    }


    public function setFirstName(string $firstname): Users
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function setLastName(string $lastname): Users
    {
        $this->lastname = $lastname;

        return $this;
    }
}

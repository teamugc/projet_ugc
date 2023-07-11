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
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setCity(string $city): Users
    {
        $this->city = $city;

        return $this;
    }

    public function setFirstName(string $firstName): Users
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(string $lastName): Users
    {
        $this->lastName = $lastName;

        return $this;
    }
}

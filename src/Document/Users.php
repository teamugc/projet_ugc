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

    // #[MongoDB\Field(type: 'Object')]
    // protected Object $preferencies;

    #[MongoDB\EmbedOne(targetDocument: Preferencies::class)]
    protected Preferencies $preferencies;



    public function getPreferencies(): Object
    {
        return $this->preferencies;
    }
    
    public function setPreferencies(Object $preferencies): Users
    {
        $this->preferencies = $preferencies;
    
        return $this;
    }

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

#[MongoDB\EmbeddedDocument]
class Preferencies
{
    #[MongoDB\Field(type: 'collection')]
    protected array $actor;

    #[MongoDB\Field(type: 'collection')]
    protected array $director;

    #[MongoDB\Field(type: 'collection')]
    protected array $genres;

    #[MongoDB\Field(type: 'string')]
    protected string $location;

    #[MongoDB\Field(type: 'string')]
    protected string $seats;


    // ...getters and setters for each property

    public function getActor(): array
    {
        return $this->actor;
    }


    public function setActor(string $actor):Preferencies
    {
        $this->actor = $actor;

        return $this;
    }

    public function getDirector(): array
    {
        return $this->director;
    }


    public function setDirector(string $director):Preferencies
    {
        $this->director = $director;

        return $this;
    }
    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(string $genres):Preferencies
    {
        $this->genres = $genres;

        return $this;
    }
    public function getLocation(): string
    {
        return $this->location;
    }


    public function setLocation(string $location):Preferencies
    {
        $this->location = $location;

        return $this;
    }

    public function getSeats(): string
    {
        return $this->seats;
    }


    public function setSeats(string $seats):Preferencies
    {
        $this->seats = $seats;

        return $this;
    }
    
}

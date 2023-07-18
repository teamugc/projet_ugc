<?php

namespace App\Document;

use DateTime;

use App\Validator\PostalCodeValidator;
use App\Validator\PostalCode;
use Symfony\Component\Validator\Constraints as Assert;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
class User
{
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'bool')]
    protected ?bool $gender = false;

    #[MongoDB\Field(type: 'string')]
    protected ?string $firstname = '';

    #[MongoDB\Field(type: 'string')]
    protected ?string $lastname = '';

    #[MongoDB\Field(type: 'string')]
    protected string $city;

    #[MongoDB\Field(type: 'string')]
    protected ?string $address = '';

    #[MongoDB\Field(type: 'int')]
    protected ?int $fidelityPoints = 0;

    #[MongoDB\Field(type: 'string')]
    protected string $password;

    #[MongoDB\Field(type: 'string')]
    protected string $phone;

    #[MongoDB\Field(type: 'int')]
    protected ?int $postalCode = 0;

    #[MongoDB\Field(type: 'date')]
    protected ?DateTime $dateOfBirth = null;

    #[MongoDB\Field(type: 'string')]
    protected string $email;

    #[MongoDB\Field(type: 'collection')]
    protected array $actor;

    #[MongoDB\Field(type: 'collection')]
    protected array $director;

    #[MongoDB\Field(type: 'collection')]
    protected array $genres;

    #[MongoDB\Field(type: 'collection')]
    protected array $location;

    #[MongoDB\Field(type: 'string')]
    protected string $seats;

    public function getGender(): string
    {
        return $this->email;
    }

    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?DateTime $dateOfBirth): User
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
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

    public function setCity(string $city): User
    {
        $this->city = $city;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    public function setFirstName(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastName(string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getFidelityPoints(): ?int
    {
        return $this->fidelityPoints;
    }

    public function setFidelityPoints(?int $fidelityPoints): User
    {
        $this->fidelityPoints = $fidelityPoints;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    
/**
     * @Assert\Regex(
     *     pattern="/^(0[1-9]|[1-8][0-9]|9[0-8])\d{3}$/",
     *     message="Le code postal doit être un code postal français valide."
     * )
     */


    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

     

    public function setPostalCode(?int $postalCode): User
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getActor(): array
    {
        return $this->actor;
    }

    public function setActor(array $actor): User
    {
        $this->actor = $actor;
        return $this;
    }

    public function getDirector(): array
    {
        return $this->director;
    }

    public function setDirector(array $director): User
    {
        $this->director = $director;
        return $this;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): User
    {
        $this->genres = $genres;
        return $this;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function setLocation(array $location): User
    {
        $this->location = $location;
        return $this;
    }

    public function getSeats(): string
    {
        return $this->seats;
    }

    public function setSeats(string $seats): User
    {
        $this->seats = $seats;
        return $this;
    }
}

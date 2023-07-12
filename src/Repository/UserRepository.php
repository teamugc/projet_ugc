<?php

namespace App\Repository;

use App\Document\Users;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository as RepositoryDocumentRepository;



// class UserRepository extends RepositoryDocumentRepository
// {
   
// }
class UserRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    // Ajoutez vos méthodes spécifiques ici
    
    public function findByFirstName(string $firstname): ?Users
    {
        return $this->findOneBy(['firstName' => $firstname]);
    }
    
    public function findByCity(string $city): array
    {
        return $this->findBy(['city' => $city]);
    }
    
    public function findByLastName(string $lastname): ?Users
    {
    return $this->findOneBy(['lastName' => $lastname]);
    }


    public function findByPhone(string $phone): ?Users
    {
        return $this->findOneBy(['phone' => $phone]);
    }

    public function findByPassword(string $password): ?Users
    {
        return $this->findOneBy(['password' => $password]);
    }

    public function findByPostalCode(string $postalCode): array
    {
        return $this->findBy(['postalCode' => $postalCode]);
    }

    public function findByFidelityPoints(int $fidelityPoints): array
    {
        return $this->findBy(['fidelityPoints' => $fidelityPoints]);
    }
}
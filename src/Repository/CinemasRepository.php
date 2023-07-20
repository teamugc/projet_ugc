<?php

namespace App\Repository;

use App\Document\Cinemas;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Component\HttpFoundation\Response;

class CinemasRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Cinemas::class);
    }

    public function save(Cinemas $users, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($users);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

}


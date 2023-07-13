<?php

namespace App\Repository;

use App\Document\Users;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class UserRepository extends ServiceDocumentRepository  
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Users::class);
    }

    public function save(Users $users, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($users);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

}


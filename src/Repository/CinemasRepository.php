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

    public function findByCriterias(string $searchData, int $limit = 0): array
    {

        $qb = $this->createQueryBuilder(Cinemas::class)
            ->field('name')->equals(new \MongoDB\BSON\Regex($searchData, 'i'));

        if ($limit)
            $qb->limit($limit);

        $datasName = $qb->getQuery()->execute()->toArray();

        $qbZipCode = $this->createQueryBuilder(Cinemas::class)
            ->field('zipcode')->equals(new \MongoDB\BSON\Regex($searchData, 'i'));

        $datasZipCode = $qbZipCode->getQuery()->execute()->toArray();

        if ($limit)
            $qb->limit($limit);

        $qbCity = $this->createQueryBuilder(Cinemas::class)
            ->field('city')->equals(new \MongoDB\BSON\Regex($searchData, 'i'));

        if ($limit)
            $qbCity->limit($limit);

        $datasCity = $qbCity->getQuery()->execute()->toArray();

        $datas = array_merge($datasName, $datasZipCode, $datasCity);

        return $datas;
    }
}

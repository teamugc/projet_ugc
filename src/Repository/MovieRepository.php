<?php

namespace App\Repository;

use App\Document\Movie;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;


class MovieRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Movie::class);
    }

    public function findByGenres(array $genres):array
    {
        return $this->createQueryBuilder()
            ->field('genres')->in($genres)
            ->getQuery()
            ->execute()->toArray();
    }
}

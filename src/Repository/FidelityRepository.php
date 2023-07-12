<?php

namespace App\Repository;

use App\Document\Fidelity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceDocumentRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry as MongoDBBundleManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository as RepositoryServiceDocumentRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceDocumentRepository<Fidelity>
 *
 * @method Fidelity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fidelity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fidelity[]    findAll()
 * @method Fidelity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FidelityRepository extends RepositoryServiceDocumentRepository
{
    public function __construct(MongoDBBundleManagerRegistry $registry)
    {
        parent::__construct($registry, Fidelity::class);
    }

//    /**
//     * @return Fidelity[] Returns an array of Fidelity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fidelity
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

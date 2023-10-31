<?php

namespace App\Repository;

use App\Entity\GroupContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupContact>
 *
 * @method GroupContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupContact[]    findAll()
 * @method GroupContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupContact::class);
    }

//    /**
//     * @return GroupContact[] Returns an array of GroupContact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupContact
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

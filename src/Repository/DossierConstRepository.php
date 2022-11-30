<?php

namespace App\Repository;

use App\Entity\DossierConst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DossierConst>
 *
 * @method DossierConst|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierConst|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierConst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierConstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierConst::class);
    }

    public function save(DossierConst $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DossierConst $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }




//    /**
//     * @return DossierConst[] Returns an array of DossierConst objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findbyid($value)
    {
        return $this->createQueryBuilder('d')
            ->where('d.user_id like :val')
            ->setParameter('val', $value)->getQuery()->getResult()
        ;
    }

    public function findbuTerrain($value)
    {
        return $this->createQueryBuilder('d')
            ->where('d.user_id like :val')
            ->setParameter('val', $value)->getQuery()->getResult()
            ;
    }
}

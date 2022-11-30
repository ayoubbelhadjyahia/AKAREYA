<?php

namespace App\Repository;

use App\Entity\MatierePremConst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MatierePremConst>
 *
 * @method MatierePremConst|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatierePremConst|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatierePremConst[]    findAll()
 * @method MatierePremConst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatierePremConstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatierePremConst::class);
    }

    public function save(MatierePremConst $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MatierePremConst $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findByWord($keyword){
        $query = $this->createQueryBuilder('a')
            ->where('a.type_matiere_const LIKE :key')->orWhere('a.id LIKE :key')
            ->setParameter('key' , $keyword.'%')->getQuery();

        return $query->getResult();
    }

//    /**
//     * @return MatierePremConst[] Returns an array of MatierePremConst objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MatierePremConst
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

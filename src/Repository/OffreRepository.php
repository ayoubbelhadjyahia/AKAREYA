<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offre>
 *
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function save(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchoffreamal($criteria)
    {
        return $this->createQueryBuilder('o')
            ->Where('o.type_bien_offre = :type_bien_offre')
            ->setParameter('type_bien_offre', $criteria->getTypeBienOffre())
            ->andWhere('o.prix_offre = :prix_offre')
            ->setParameter('prix_offre', $criteria->getPrixOffre())
            ->andWhere('o.superficie_offre = :superficie_offre')
            ->setParameter('superficie_offre', $criteria->getSuperficieOffre())
            ->andWhere('o.adresse_offre = :adresse_offre')
            ->setParameter('adresse_offre', $criteria->getAdresseOffre())
            ->getQuery()
            ->getResult()
            ;
    }
    public function remove(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Offre p
                WHERE p.type_bien_offre LIKE :str
               '
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }


//    public function findOneBySomeField($value): ?Offre
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

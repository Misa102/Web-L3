<?php

namespace App\Repository\Sandbox;

use App\Entity\Sandbox\ProduitsMagasin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProduitsMagasin>
 *
 * @method ProduitsMagasin|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsMagasin|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsMagasin[]    findAll()
 * @method ProduitsMagasin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsMagasinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitsMagasin::class);
    }

    public function save(ProduitsMagasin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProduitsMagasin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProduitsMagasin[] Returns an array of ProduitsMagasin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProduitsMagasin
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

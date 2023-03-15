<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function save(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Recherche un produit d'après son id en pré-téléchargeant
     * tous les magasins auquel il est lié
     *
     * @param int $id clé primaire d'un produit
     * @return Produit|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithMagasins(int $id): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->leftJoin('p.produitMagasins', 'pm')
            ->addSelect('pm')
            ->leftJoin('pm.magasin', 'm')
            ->addSelect('m')
            ->getQuery()
            ->getOneOrNullResult();
    }

    // même fonction mais avec des explications
    public function findWithMagasinsAvecExplications(int $id): ?Produit
    {
        return
            $this
                // crée un QueryBuilder sur l'entité Produit sur toutes les colonnes avec l'alias "p" (pour "produit")
                // -> SELECT * FROM ts_produits p
                ->createQueryBuilder('p')
                // ajout d'une contrainte sur la propriété 'id' de l'entité p (i.e. Produit)
                // -> WHERE p.id = $id       -- c'est le setParameter ci-dessous qui remplace ':id' par $id
                ->where('p.id = :id')
                // attribution d'une valeur pour le paramètre du where ci-dessus
                ->setParameter('id', $id)
                // left join avec l'entité ProduitMagasin : pas de inner join car le produit peut ne pas être
                // présent dans la table liée à ProduitMagasin
                // -> LEFT JOIN ts_produits_magasins pm ON p.id = pm.id_produit
                ->leftJoin('p.produitMagasins', 'pm')
                // ajoute "pm.*" au SELECT (addSelect et pas select, sinon on écrase le premier select)
                ->addSelect('pm')
                // left join avec l'entité Magasin
                // -> LEFT JOIN ts_magasin m ON pm.id_magasin = m.id
                ->leftJoin('pm.magasin', 'm')
                // ajoute "m.*" au SELECT
                ->addSelect('m')
                // récupération de la Query
                ->getQuery()
                // récupération des résultats : on précise qu'il y a 0 ou 1 résultat (NonUniqueResultException sinon)
                ->getOneOrNullResult();
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
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

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

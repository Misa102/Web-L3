<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Magasin;
use App\Entity\Manuel;
use App\Entity\Pays;
use App\Entity\Produit;
use App\Entity\ProduitMagasin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VenteFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {
        /* ===========================================================
         * = pays
         * ===========================================================*/
        $pays1 = new Pays();
        $pays1
            ->setNom('France')
            ->setCode('FR');
        $em->persist($pays1);

        $pays2 = new Pays();
        $pays2
            ->setNom('Allemagne');
        // code mis à null par défaut
        $em->persist($pays2);

        $pays3 = new Pays();
        $pays3
            ->setNom('Liban')
            ->setCode('LB');
        $em->persist($pays3);


        /* ===========================================================
         * = magasins
         * ===========================================================*/
        $magasin1 = new Magasin();
        $magasin1
            ->setNom('AAAAA');
        $em->persist($magasin1);

        $magasin2 = new Magasin();
        $magasin2
            ->setNom('BBBBB');
        $em->persist($magasin2);

        $magasin3 = new Magasin();
        $magasin3
            ->setNom('CCCCC');
        $em->persist($magasin3);

        $magasin4 = new Magasin();
        $magasin4
            ->setNom('DDDDD');
        $em->persist($magasin4);


        /* ===========================================================
         * = produit 1
         * ===========================================================*/
        // pas de manuel

        $produit1 = new Produit();
        $produit1
            ->setDenomination('voiture')
            ->setCode('7 11 654 876')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 11111')
            ->setManuel(null);      // inutile car valeur par défaut
        //->addPays($pays1);           // incomplet : le pays ne contient pas le produit
        $em->persist($produit1);

        $pays1->addProduit($produit1);     // complet : les deux entités se connaissent
        $pays3->addProduit($produit1);

        $produit1Magasin1 = new ProduitMagasin();
        $produit1Magasin1
            ->setProduit($produit1)        // inutile vu l'appel ci-dessous à addProduitMagasin
            ->setMagasin($magasin1)        // inutile vu l'appel ci-dessous à addProduitMagasin
            ->setQuantite(113)
            ->setPrixUnitaire(3.14);
        $em->persist($produit1Magasin1);
        // obligé d'appeler ces deux méthodes pour avoir une connaissance mutuelle (même si c'est inutile pour les fixtures)
        $produit1->addProduitMagasin($produit1Magasin1);
        $magasin1->addProduitMagasin($produit1Magasin1);

        $produit1Magasin2 = new ProduitMagasin();
        $produit1Magasin2
            ->setProduit($produit1)
            ->setMagasin($magasin2)
            ->setQuantite(95)
            ->setPrixUnitaire(3.37);
        $em->persist($produit1Magasin2);
        $produit1->addProduitMagasin($produit1Magasin2);
        $magasin2->addProduitMagasin($produit1Magasin2);

        $produit1Magasin4 = new ProduitMagasin();
        $produit1Magasin4
            ->setProduit($produit1)
            ->setMagasin($magasin4)
            ->setQuantite(29)
            ->setPrixUnitaire(3.99);
        $em->persist($produit1Magasin4);
        $produit1->addProduitMagasin($produit1Magasin4);
        $magasin4->addProduitMagasin($produit1Magasin4);

        $image1_1 = new Image();
        $image1_1
            ->setUrl('http://image1_1')
            ->setUrlMini('http://ahg893vdx')
            ->setAlt('une image 1 1')
            ->setProduit($produit1);
        $em->persist($image1_1);

        $image1_2 = new Image();
        $image1_2
            ->setUrl('http://image1_2')
            ->setUrlMini(null)               // valeur par défaut
            ->setAlt('une image 1 2')
            ->setProduit($produit1);
        $em->persist($image1_2);


        /* ===========================================================
         * = produit 2
         * ===========================================================*/
        $manuel2 = new Manuel();
        $manuel2
            ->setUrl('http://aaaaa')
            ->setSommaire('I titre; II pas titre');
        $em->persist($manuel2);

        $produit2 = new Produit();
        $produit2
            ->setDenomination('skate')
            ->setCode('5 21 749 559')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 22222')
            ->setManuel($manuel2);
        $em->persist($produit2);

        $pays1->addProduit($produit2);

        $produit2Magasin1 = new ProduitMagasin();
        $produit2Magasin1
            ->setProduit($produit2)
            ->setMagasin($magasin1)
            ->setQuantite(33)
            ->setPrixUnitaire(59.99);
        $em->persist($produit2Magasin1);
        $produit2->addProduitMagasin($produit2Magasin1);
        $magasin1->addProduitMagasin($produit2Magasin1);

        $produit2Magasin4 = new ProduitMagasin();
        $produit2Magasin4
            ->setProduit($produit2)
            ->setMagasin($magasin4)
            ->setQuantite(7)
            ->setPrixUnitaire(65.99);
        $em->persist($produit2Magasin4);
        $produit2->addProduitMagasin($produit2Magasin4);
        $magasin4->addProduitMagasin($produit2Magasin4);

        $image2_1 = new Image();
        $image2_1
            ->setUrl('http://image2_1')
            ->setUrlMini('http://jsg09gr')
            ->setAlt('une image 2 1')
            ->setProduit($produit2);
        $em->persist($image2_1);

        $image2_2 = new Image();
        $image2_2
            ->setUrl('http://image2_2')
            ->setUrlMini('http://gh38mf')
            ->setAlt('une image 2 2')
            ->setProduit($produit2);
        $em->persist($image2_2);

        $image2_3 = new Image();
        $image2_3
            ->setUrl('http://image2_3')
            ->setUrlMini('http://bvte54')
            ->setAlt('une image 2 3')
            ->setProduit($produit2);
        $em->persist($image2_3);


        /* ===========================================================
         * = produit 3
         * ===========================================================*/
        // pas de manuel

        $produit3 = new Produit();
        $produit3
            ->setDenomination('vélo')
            ->setCode('2 45 814 445')
            ->setDateCreation(new \DateTime())
            ->setActif(false)
            ->setDescriptif('descriptif 33333')
            ->setManuel(null);      // inutile car valeur par défaut
        $em->persist($produit3);

        // pas de pays

        // pas de magasin

        // pas d'image


        /* ===========================================================
         * = produit 4
         * ===========================================================*/
        $manuel4 = new Manuel();
        $manuel4
            ->setUrl('http://bbbb')
            ->setSommaire(null);
        $em->persist($manuel4);

        $produit4 = new Produit();
        $produit4
            ->setDenomination('avion')
            ->setCode('8 44 783 712')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 44444')
            ->setManuel($manuel4);
        $em->persist($produit4);

        $pays3->addProduit($produit4);

        $produit4Magasin2 = new ProduitMagasin();
        $produit4Magasin2
            ->setProduit($produit4)
            ->setMagasin($magasin2)
            ->setQuantite(5)
            ->setPrixUnitaire(5000001.12);
        $em->persist($produit4Magasin2);
        $produit4->addProduitMagasin($produit4Magasin2);
        $magasin2->addProduitMagasin($produit4Magasin2);

        $produit4Magasin4 = new ProduitMagasin();
        $produit4Magasin4
            ->setProduit($produit4)
            ->setMagasin($magasin4)
            ->setQuantite(3)
            ->setPrixUnitaire(5000000.10);
        $em->persist($produit4Magasin4);
        $produit4->addProduitMagasin($produit4Magasin4);
        $magasin4->addProduitMagasin($produit4Magasin4);

        // pas d'image


        $em->flush();
    }
}

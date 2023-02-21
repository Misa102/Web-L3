<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/magasin', name: 'magasin')]
class MagasinController extends AbstractController
{
    #[Route(
        '/valeur-stock/{id}',
        name: '_valeur_stock',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function valeurStockAction(int $id): Response
    {
        // total fictif en attendant une requête sur la base de données
        $total = 315726;
        $args = array(
            'id' => $id,
            'total' => $total,
        );
        return $this->render('Magasin/valeurStock.html.twig', $args);
    }

    #[Route(
        '/stock/{id}/{valinf}/{valsup}',
        name: '_stock',
        requirements: [
            'id' => '[1-9]\d*',
            'valinf' => '0|[1-9]\d*',
            'valsup' => '-1|0|[1-9]\d*',
        ],
        defaults: [
            'valinf' => 0,
            'valsup' => -1,
        ],
    )]
    public function stockAction(int $id, int $valinf, int $valsup): Response
    {
        // liste fictive en attendant l'interrogation de la base de données
        $produits = array(
            [ 'denomination' => 'marteau',   'quantite' => 37, 'prixUnitaire' => 22 ],
            [ 'denomination' => 'tournevis', 'quantite' => 12, 'prixUnitaire' => 24 ],
            [ 'denomination' => 'perçeuse',  'quantite' => 8,  'prixUnitaire' => 258 ],
        );
        $args = array(
            'id' => $id,
            'valinf' => $valinf,
            'valsup' => $valsup,
            'produits' => $produits,
        );
        return $this->render('Magasin/stock.html.twig', $args);
    }
}


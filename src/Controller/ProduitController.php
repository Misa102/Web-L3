<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



//8.2 crud sur la table produit



#[Route('/produit', name: 'produit')]
class ProduitController extends AbstractController
{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return $this->redirectToRoute('produit_list', ['page' => 1]);
    }

    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: [ 'page' => 0],        // la valeur par défaut ne respecte pas les contraintes
    )]
    public function listAction(int $page): Response
    {
        $args = array(
            'page' => $page,
            'produits' => array(
                ['id' => 2, 'denomination' => 'RAM',     'code' => '97558143', "actif" => false],
                ['id' => 5, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
                ['id' => 6, 'denomination' => 'clavier', 'code' => '33278214', "actif" => true],
            ),
        );
        return $this->render('Produit/list.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id): Response
    {
        // simule l'interrogation de la base avec $id qui aurait la valeur 5
        $args = array(
            'produit' => ['id' => 5, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
        );
        return $this->render('Produit/view.html.twig', $args);
    }

    #[Route(
        '/add',
        name: '_add',
    )]
    public function addAction(): Response
    {
        $this->addFlash('info', 'échec ajout produit');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function editAction(int $id): Response
    {
        $this->addFlash('info', 'échec modification produit ' . $id);
        return $this->redirectToRoute('produit_view', ['id' => $id]);
    }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id): Response
    {
        $this->addFlash('info', 'échec suppression produit ' . $id);
        return $this->redirectToRoute('produit_list');
    }

    // 8.4 crud et jointures
    public function paysAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/pays');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/magasin/add',
        name: '_magasin_add',
    )]
    public function magasinAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/magasin');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

}


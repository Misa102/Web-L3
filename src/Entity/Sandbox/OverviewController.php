<?php

namespace App\Entity\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OverviewController extends AbstractController
{
    #[Route('/sandbox/overview', name: 'sandbox_overview_hello1')]
    public function indexAction(): Response
    {
        return new Response('<body>Hello World!</body>');
    }

    // 6.2 création d'une seconde action
    #[Route('/sandbox/overview/hello2', name: 'sandbox_overview_hello2')]
    public function hello2Action(): Response
    {
        return $this -> render('Sandbox/Overview/hello2.html.twig');
    }

    // 6.6 un peu de Twig
    #[Route('/sandbox/overview/hello3', name: 'sandbox_overview_hello3')]
    public function hello3Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => ['A Plague Tale : Innocence', 'WoW', "Mass Effect", 'Life is Strange'],
        );
        return $this->render('Sandbox/Overview/hello3.html.twig', $args);
    }

    #[Route('/sandbox/overview/hello4', name: 'sandbox_overview_hello4')]
    public function hello4Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => ['A Plague Tale : Innocence', 'WoW', "Mass Effect", 'Life is Strange'],
        );
        return $this->render('Sandbox/Overview/hello4.html.twig', $args);
    }


}

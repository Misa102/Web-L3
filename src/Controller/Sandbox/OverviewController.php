<?php

namespace App\Controller\Sandbox;

use http\Message\Body;
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
        return new Response('<body>Hello World number 2!</body>');
    }
}

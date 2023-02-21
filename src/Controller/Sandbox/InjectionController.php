<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

#[Route('/sandbox/injection', name: 'sandbox_injection')]
class InjectionController extends AbstractController
{
    #[Route('/un', name: '_un')]
    public function unAction(Request $request): Response
    {
        dump($request -> getMethod());
        dump($request -> query -> get('foo'));
        dump($request -> query -> all());
        dump($request -> cookies -> all());
        return new Response('<body>Injection::un</body>');
    }

    #[Route('/deux', name: '_deux')]
    public function deuxAction(Request $request, Session $session): Response
    {
        // note : on peut aussi récupérer la session avec : $request->getSession();
        if ($request->query->get('compteur') !== null)
            $session->set('compteur', $request->query->get('compteur'));
        elseif ($request->query->get('inc') !== null)
            $session->set('compteur', $session->get('compteur') + 1);
        elseif ($request->query->get('supp') !== null)
            $session->remove('compteur');
        dump($session->all());
        dump($_SESSION);
        return new Response('<body>Injection::un</body>');
    }

    //7.1 creation des messages flash
    #[Route('/create-flash', name: '_create_flash')]
    public function createFlashAction(Session $session): Response
    {
        // par exemple cette action supprime une entrée dans la base de données
        $session->getFlashBag()->add('info', 'L\'enregistrement a été supprimé');
        $this->addFlash('info', 'L\'enregistrement a été supprimé (bis repetita)');
        return $this->redirectToRoute('sandbox_injection_display_flash');
    }

    //7.2 affichage des messages flash
    #[Route('/display-flash', name: '_display_flash')]
    public function displayFlashAction(): Response
    {
        return $this->render('Sandbox/Injection/displayFlash.html.twig');
    }

}

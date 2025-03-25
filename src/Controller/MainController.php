<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'accueil_index')]
    public function indexAction(): Response
    {
        $moi = $this->getParameter('moi'); // Récupère la variable depuis services.yaml
        return $this->render('index.html.twig', ['moi' => $moi,]);
    }

    // pour inclusion de contrôleur dans le template secondaire : action non routable
    public function menuAction(): Response
    {
        $args = array(
        );
        return $this->render('templates/_menu.html.twig', $args);
    }
}

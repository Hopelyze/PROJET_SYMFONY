<?php

namespace App\Controller;

use App\Service\DatabaseHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function indexAction(EntityManagerInterface $entityManager): Response
    {
        $moi = $this->getParameter('moi'); // Récupère la variable depuis services.yaml

        return $this->render('Main/index.html.twig', [
            'moi' => $moi,
        ]);
    }

    public function menuAction(): Response
    {
        $args = array(
            // Add any required arguments here
        );
        return $this->render('Layouts/_menu.html.twig', $args);
    }
}

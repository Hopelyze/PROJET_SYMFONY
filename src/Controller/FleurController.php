<?php
namespace App\Controller;

use App\Entity\Fleurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FleurController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $fleurs = $entityManager->getRepository(Fleurs::class)->findAll();

        return $this->render('index.html.twig', [
            'fleurs' => $fleurs,
            'moi' => 'Visiteur', // À remplacer par l'utilisateur authentifié si besoin
        ]);
    }
}
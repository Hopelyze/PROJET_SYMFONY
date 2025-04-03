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
        $user = $this->getUser();
        $fullname = 'anonyme';
        $country = 'france';
        $role = 'Aucun rôle';

        if ($user){
            $id = $user->getId();
            $fullname = $user->getName() . ' ' . $user->getForename();
            $country = $user->getCountry() ? $user->getCountry()->getName() : 'france';
            $role = implode(', ', $user->getRoles()); // Récupérer les rôles de l'utilisateur
        }

        return $this->render('Main/index.html.twig', [
            'fullname' => $fullname,
            'country' => $country,
            'role' => $role, 
        ]);
    }

    public function menuAction(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $id = is_null($user) ? null : $user->getId();

        return $this->render('Layouts/_menu.html.twig');
    }
}

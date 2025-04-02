<?php
namespace App\Controller;

use App\Entity\Flowers;
use App\Entity\Cart;
use App\Repository\FlowersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/product', name: 'product')]
final class ProductController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(EntityManagerInterface $manager): Response
    {
        $flowers = $manager->getRepository(Flowers::class)->findAll();

        return $this->render('Product/list.html.twig', [
            'flowers' => $flowers, 
        ]);
    }

    #[Route('/cart', name: '_cart')]
    public function cartAction(EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);

        $totalPrice = 0;
        foreach ($cartContents as $content) {
            $totalPrice += $content->getFlower()->getPrice() * $content->getQuantity();
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => ['cartContents' => $cartContents],
            'totalPrice' => $totalPrice,
        ]);
    }
}

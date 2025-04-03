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

    #[Route('/remove/{id}', name: '_remove')]
    public function removeAction(int $id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);

        $produit = $cartContents->find($id);

        if (is_null($produit))
            throw $this->createNotFoundException('erreur suppression produit ' . $id);

        $manager->remove($produit);
        $manager->flush();
        $this->addFlash('info', 'suppression produit ' . $id . ' reussie');

        $totalPrice = 0;
        foreach ($cartContents as $content) {
            $totalPrice += $content->getFlower()->getPrice() * $content->getQuantity();
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => ['cartContents' => $cartContents],
            'totalPrice' => $totalPrice,
        ]);
    }

    #[Route('/cart/clear', name: '_cart_clear')]
    public function cartClearAction(EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);


        #suppression de toute la liste ie besoin de récuperer tout les id et d'appeler iterativement removeAction

        return $this->render('cart/cart.html.twig', [
            'cart' => ['cartContents' => $cartContents],
            'totalPrice' => $totalPrice,
        ]);
    }

    #[Route('/cart/checkout', name: '_cart_checkout')]
    public function cartCheckoutAction(EntityManagerInterface $manager): Response
    {
        $this->addFlash('info', 'Achat réalisé');
        return $this->redirectToRoute('cart', $manager);
    }

}

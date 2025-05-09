<?php
namespace App\Controller;

use App\Entity\Flowers;
use App\Entity\Cart;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/add/{id}/{quantity}', name: '_add')]
    public function addAction(Flowers $flower, int $quantity, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();

        if (is_null($user))
        {
            throw $this->createNotFoundException('erreur user non identifie' . $id);
        }

        $idUser = $user->getId();
        
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);

        $produit = new Cart();
        $produit->setUser($user);
        $produit->setFlower($flower);
        $produit->setQuantity($quantity);

        $manager->persist($produit);
        $manager->flush();

        return $this->redirectToRoute('product_cart');

    }


    #[Route('/remove/{id}', name: '_remove')]
    public function removeAction(int $id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);

        $produit = null;
        foreach ($cartContents as $item) {
            if ($item->getId() == $id) {
                $produit = $item;
                break;
            }
        }

        if (is_null($produit)){
            throw $this->createNotFoundException('erreur suppression produit ' . $id);
        }

        $manager->remove($produit);
        $manager->flush();
        $this->addFlash('info', 'suppression produit ' . $id . ' reussie');

        return $this->redirectToRoute('product_cart');
    }

    #[Route('/cart/clear', name: '_cart_clear')]
    public function cartClearAction(EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $cartContents = $manager->getRepository(Cart::class)->findBy(['user' => $user]);

        $produit = $cartContents->findAll();

        if (is_null($produit))
        {
            throw $this->createNotFoundException('erreur suppression produit ' . $id);
        }

        $manager->remove($produit);
        $manager->flush();
        $this->addFlash('info', 'suppression des produits ' . $id . ' reussie');

        return $this->redirectToRoute('product_cart');
    }

    #[Route('/cart/checkout', name: '_cart_checkout')]
    public function cartCheckoutAction(EntityManagerInterface $manager): Response
    {
        $this->addFlash('info', 'Achat réalisé');
        return $this->redirectToRoute('product_cart');
    }

    #[Route('/create', name: '_create')]
    public function createAction(Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $flower = new Flowers();
        $form = $this->createForm(ProductType::class, $flower);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($flower);
            $manager->flush();

            $this->addFlash('success', 'Le produit a été ajouté avec succès.');
            return $this->redirectToRoute('main');  
        }

        return $this->render('Product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
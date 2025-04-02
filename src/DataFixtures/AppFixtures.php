<?php

namespace App\DataFixtures;
use App\Entity\Flowers;
use App\Entity\Cart;
use App\Entity\App;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Correct namespace

class AppFixtures extends Fixture
{
    private ?UserPasswordHasherInterface $passwordHasher = null;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $DataFlowers = [
            ['Roses rouges', 9.99, 50, 'images/roses_rouges.jpg'],
            ['Tulipes jaunes', 7.50, 30, 'images/tulipes_jaunes.jpg'],
            ['Orchidées blanches', 15.00, 20, 'images/orchidees_blanches.jpg'],
            ['Lys rose', 12.00, 40, 'images/lys_rose.jpg'],
            ['Lavande', 8.00, 35, 'images/lavande.jpg'],
        ];

        foreach ($DataFlowers as [$wording, $price, $quantityStock, $image]) {
            $flowers = new Flowers();
            $flowers->setWording($wording);
            $flowers->setPrice($price);
            $flowers->setQuantityStock($quantityStock);
            $flowers->setImage($image); 
            $manager->persist($flowers);
        }
        
        $user0 = new User();
        $user0
            ->setLogin('sadmin')
            ->setPassword($this->passwordHasher->hashPassword($user0, 'nimdas'))
            ->setName('Mere')
            ->setSurname(' Nature')
            ->setBirthday(date_create("1900-01-01"))
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user0);


        $user1 = new User();
        $user1 
            ->setLogin('gilles')
            ->setPassword($this->passwordHasher->hashPassword($user1, 'sellig')) // Corrected variable name
            ->setName('Gilles')
            ->setForename('Subrenat')
            ->setBirthday(null) 
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);

        $user2 = new User();
        $user2 
            ->setLogin('rita')
            ->setPassword($this->passwordHasher->hashPassword($user2,'atir'))
            ->setName('Rita')
            ->setForename('Zrour')
            ->setBirthday(null) 
            ->setAdmin(false)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $user3  = new User();
        $user3 
            ->setLogin('boumediene')
            ->setPassword($this->passwordHasher->hashPassword($user3,'eneidemuob'))
            ->setName('Boumediene')
            ->setForename('Saidi')
            ->setBirthday(null) 
            ->setAdmin(false)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user3);

        $user4 = new User();
        $user4 
            ->setLogin('chloe')
            ->setPassword($this->passwordHasher->hashPassword($user4,'eolhc'))
            ->setName('Chloe')
            ->setForename('Lepretre')
            ->setBirthday(null) 
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user4);

        $user5 = new User();
        $user5 
            ->setLogin('chloe')
            ->setPassword($this->passwordHasher->hashPassword($user5,'eolhc'))
            ->setName('Claire')
            ->setForename('Besancon')
            ->setBirthday(date_create("2004-03-08"))
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user4);



        $cart1 = new Cart();
        $cart1
            ->setCart('Panier de Gilles')
            ->setUser($user1);
        $manager->persist($cart1);

        $cart2 = new Cart();
        $cart2
            ->setCart('Panier de Rita')
            ->setUser($user2);
        $manager->persist($cart2);

        $cart3 = new Cart();   
        $cart3
            ->setCart('Panier de Boumediene')
            ->setUser($user3);
        $manager->persist($cart3);

        $cart4 = new Cart();
        $cart4
            ->setCart('Panier de Chloe')
            ->setUser($user4);
        $manager->persist($cart4);


        $manager->flush();
    }
}

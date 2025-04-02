<?php

namespace App\DataFixtures;
use App\Entity\Flowers;
use App\Entity\Cart;
use App\Entity\Country;
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

        $flowers = [];
        foreach ($DataFlowers as [$wording, $price, $quantityStock, $image]) {
            $flower = new Flowers();
            $flower->setWording($wording);
            $flower->setPrice($price);
            $flower->setQuantityStock($quantityStock);
            $flower->setImage($image); 
            $manager->persist($flower);
            $flowers[] = $flower;
        }
        
        $country1 = new Country();
        $country1
            ->setName('France')
            ->setCode('FR');
        $manager->persist($country1);

        $country2 = new Country();
        $country2
            ->setName('Allemagne')
            ->setCode('DE');
        $manager->persist($country2);

        $country3 = new Country();  
        $country3
            ->setName('Namibie')
            ->setCode('NA');
        $manager->persist($country3);
        
        $country4 = new Country();  
        $country4
            ->setName('Belgique')
            ->setCode('BE');    
        $manager->persist($country4);

        $country5 = new Country();  
        $country5
            ->setName('Suisse')
            ->setCode('CH');
        $manager->persist($country5);   

        $country6 = new Country();
        $country6
            ->setName('Espagne')
            ->setCode('ES');
        $manager->persist($country6);


        $country7 = new Country();  
        $country7
            ->setName('Portugal')
            ->setCode('PT');
        $manager->persist($country7);   

        $country8 = new Country();
        $country8
            ->setName('Italie')
            ->setCode('IT');
        $manager->persist($country8);

        $country9 = new Country();
        $country9
            ->setName('Royaume-Uni')
            ->setCode('GB');
        $manager->persist($country9);

        $country10 = new Country();         
        $country10
            ->setName('Sénégal')
            ->setCode('SN');
        $manager->persist($country10);

        $country11 = new Country();
        $country11
            ->setName('Maroc')
            ->setCode('MA');
        $manager->persist($country11);

        $country12 = new Country();
        $country12
            ->setName('Algérie')
            ->setCode('DZ');
        $manager->persist($country12);
        

        $user0 = new User();
        $user0
            ->setLogin('sadmin')
            ->setPassword($this->passwordHasher->hashPassword($user0, 'nimdas'))
            ->setName('Mere')
            ->setForename('Nature')
            ->setBirthday(new \DateTimeImmutable("1900-01-01")) // Use DateTimeImmutable
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setCountry($country1);
        $manager->persist($user0);


        $user1 = new User();
        $user1 
            ->setLogin('gilles')
            ->setPassword($this->passwordHasher->hashPassword($user1, 'sellig')) // Corrected variable name
            ->setName('Gilles')
            ->setForename('Subrenat')
            ->setBirthday(null) 
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN'])
            ->setCountry($country1); // Set the country
        $manager->persist($user1);

        $user2 = new User();
        $user2 
            ->setLogin('rita')
            ->setPassword($this->passwordHasher->hashPassword($user2,'atir'))
            ->setName('Rita')
            ->setForename('Zrour')
            ->setBirthday(null) 
            ->setAdmin(false)
            ->setRoles(['ROLE_USER'])
            ->setCountry($country1);
        $manager->persist($user2);

        $user3  = new User();
        $user3 
            ->setLogin('boumediene')
            ->setPassword($this->passwordHasher->hashPassword($user3,'eneidemuob'))
            ->setName('Boumediene')
            ->setForename('Saidi')
            ->setBirthday(null) 
            ->setAdmin(false)
            ->setRoles(['ROLE_USER'])
            ->setCountry($country1);
        $manager->persist($user3);

        $user4 = new User();
        $user4 
            ->setLogin('chloe')
            ->setPassword($this->passwordHasher->hashPassword($user4,'eolhc'))
            ->setName('Chloe')
            ->setForename('Lepretre')
            ->setBirthday(null) 
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN'])
            ->setCountry($country1);
        $manager->persist($user4);

        $user5 = new User();
        $user5 
            ->setLogin('claire')
            ->setPassword($this->passwordHasher->hashPassword($user5,'eolhc'))
            ->setName('Claire')
            ->setForename('Besancon')
            ->setBirthday(new \DateTimeImmutable("2004-03-08")) // Use DateTimeImmutable
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN'])
            ->setCountry($country1);
        $manager->persist($user5);



        $cart1 = new Cart();
        $cart1
            ->setCart('Panier de Gilles')
            ->setUser($user1)
            ->setFlower($flowers[0]) // Ensure a flower is set
            ->setQuantity(2);
        $manager->persist($cart1);

        $cart2 = new Cart();
        $cart2
            ->setCart('Panier de Rita')
            ->setUser($user2)
            ->setFlower($flowers[1]) // Ensure a flower is set
            ->setQuantity(3);
        $manager->persist($cart2);

        $cart3 = new Cart();   
        $cart3
            ->setCart('Panier de Boumediene')
            ->setUser($user3)
            ->setFlower($flowers[2]) // Example flower
            ->setQuantity(1); // Set quantity
        $manager->persist($cart3);

        $cart4 = new Cart();
        $cart4
            ->setCart('Panier de Chloe')
            ->setUser($user4)
            ->setFlower($flowers[3]) // Example flower
            ->setQuantity(4); // Set quantity
        $manager->persist($cart4);

    
        $manager->flush();
    }
}

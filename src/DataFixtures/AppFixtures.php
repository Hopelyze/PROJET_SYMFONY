<?php

namespace App\DataFixtures;

use App\Entity\App;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
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

        $manager->flush();
    }
}

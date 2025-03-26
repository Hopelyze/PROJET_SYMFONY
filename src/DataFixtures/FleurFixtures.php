<?php

namespace App\DataFixtures;

use App\Entity\Fleurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FleurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fleursData = [
            ['Roses rouges', 9.99, 50],
            ['Tulipes jaunes', 7.50, 30],
            ['Orchidées blanches', 15.00, 20],
            ['Lys rose', 12.00, 40]
        ];

        foreach ($fleursData as [$libelle, $prix, $quantiteStock]) {
            $fleur = new Fleurs();
            $fleur->setLibelle($libelle);
            $fleur->setPrix($prix);
            $fleur->setQuantiteStock($quantiteStock);
            $manager->persist($fleur);
        }

        $manager->flush();
    }
}

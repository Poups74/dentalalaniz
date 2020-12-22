<?php

namespace App\DataFixtures;

use App\Entity\MembreEquipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreEquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($i=0 ; $i<50 ;$i++)
        {       

            $membreEquipe =(new MembreEquipe())

            ->setCivilite('Mme')
            ->setNom('test')
            ->setPrenom('est')
            ->setMetier('est')
            ->setSpecialite('est')
            ->setDescriptionMetier('est')
            ->setExperience('est')
            ->setFormation('est');
          

    // $product = new Product();
    $manager->persist($membreEquipe);

    $manager->flush();

        }

        
    }
}

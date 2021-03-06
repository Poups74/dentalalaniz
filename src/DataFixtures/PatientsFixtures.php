<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PatientsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for($i=0 ; $i<50 ;$i++)
        {       

            $patients =(new Patient())
            ->setCivilite('f')
            ->setNom('NomPatient' . $i)
            ->setPrenom('est' . $i)
            ->setEmail('Mail'. $i . '@gmail.com')
            ->setTelephone('01234')
            ;
                
            $manager->persist($patients);

            $manager->flush();

        }
    }

}


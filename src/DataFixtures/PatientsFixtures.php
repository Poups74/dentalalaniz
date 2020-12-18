<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PatientsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($i=0 ; $i<50 ;$i++)
        {       

            $patients =(new Patient())

            ->setNom('NomPatient' . $i)
            ->setPrenom('est' . $i)
            ->setMail('Mail'. $i . '@gmail.com')
            ;
                
            $manager->persist($patients);

            $manager->flush();

        }

}

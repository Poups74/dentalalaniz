<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\MembreEquipe;
use App\Service\UploaderService;
use DirectoryIterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class MembreEquipeFixtures  extends BaseFixture 
{

    private $uploader ;

    public function __construct( UploaderService  $uploader)
    {
       $this->uploader=$uploader;
       
    }

    public function loadData() :void 
    {

        $fs = new Filesystem();
        $fs->remove(UploaderService::MEMBRE_EQUIPE);
        $fs->mkdir(UploaderService::MEMBRE_EQUIPE);
        $fs->touch(UploaderService::MEMBRE_EQUIPE.'/.gitignore');


        $this->createMany(50, 'membre_equipe',function()use($fs){
            
            $cheminImage =__DIR__.'/fakePhotos/images/FakePhoto.jpg';
            $cheminTmp = sys_get_temp_dir().'/FakePhoto.jpg';
       
            $fs->copy($cheminImage, $cheminTmp);

            $file= new File($cheminTmp);
            $fileName= $this->uploader->saveMembreEquipePhoto($file);


            return(new MembreEquipe())
             ->setTitre($this->faker->title)
             ->setCivilite($this->faker->randomElement(['m','f']))
             ->setNom($this->faker->lastName)
             ->setPrenom($this->faker->firstName)
             ->setMetier($this->faker->jobTitle)
             ->setSpecialite($this->faker->jobTitle)
             ->setDescriptionMetier($this->faker->sentence)
             ->setExperience($this->faker->realText())
             ->setFormation($this->faker->realText())
             ->setImage($fileName);
             ; 
          
    
        });
    
    
}
}

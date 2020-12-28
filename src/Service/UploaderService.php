<?php

namespace App\Service ;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class UploaderService 
{
    public const MEMBRE_EQUIPE = __DIR__.'/../../public/images';
    // Il faut générer un nom de fichier 
    public function saveMembreEquipePhoto(File $file):string
    {
        return $this->uploadFile($file, self::MEMBRE_EQUIPE);
    }


    private function uploadFile(File $file, string $dossier):string
    {
      
        $name = uniqid(time()).'.'. $file->guessExtension();
        $file->move($dossier, $name);
        return $name;

        
      
        // Je dois génerer un nom de fichier unique et aléatoire avec l'extention originale du fichier 
        // Je vais utiliser cette variable pour créer le nom du fichier 
        // Enregistrer  avec la méthode move le fichier au bon endroit
        // retourner le nom du fichier 
 
    

    }

}


  
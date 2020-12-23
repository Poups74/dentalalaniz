<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;
use Faker\Generator;


/**
 * classe abstraite pour simplifier l'enregistrement des entités. Elle embarque Faker pour générer les données aléatoires, et permet de récuperer des entités aléatoires
 */
abstract class BaseFixture extends Fixture
{
  private $manager;

/** @var Generator 
 * 
*/
protected $faker;


/**
 * Listes de références vers des entités
 *  @var string[][] un tableau contenant des tableaux de chaine de caractères
 */
private $references =[];

/** Méthode à implémenter pour charger les entités 
 * 
 * Une méthode abstraite ne possède pas de corps et doit être obligatoirement implémentée par les classes qui héritent de BasFixture
 */

abstract protected  function loadData():void ;


/** Méthode initialement appellée par le système de Fixtures
 * On enregistre nos propriétés(manager et faker) et ensuite on appelle loadData()
 */

public function load(ObjectManager $manager)
      {

          
            $this->manager =$manager;
            $this->faker = Factory::create('es_ES');


            // Les entités seront générées dans loadData(), aui aura donc appelé $manager->persist()
            $this->loadData();
            $this->manager->flush();

      }
/**
 * Le role de la méthode suivante est de créer un certain nombre d'entités . On aura un premier argument qui sera un entier (le nombre d'entités à  générer), et un deuxième argument qui sera une fonction anonyme ,(un callback) de type callable, qui sera la fonction qui doit générer une entité à la fois
*
* @param int $count          nombre d'entités à générer 
*@param string $groupname Le nom a donner en reference pour toutes les entites generees
* @param callable $factory      La fonction qui doit générer une entité
 */
protected function createMany(int $count,string $groupname, callable $factory):void

{
    for($i=0; $i<$count ; $i++){

    $entity =  $factory($i);

    if($entity === null){

        throw new \LogicException('Pas d\'entité');
    }
    // On va preparer vl'enregistrement de l'entité
    $this->manager->persist($entity);

    
    }

}

}
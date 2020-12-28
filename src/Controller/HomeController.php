<?php

namespace App\Controller;

use App\Entity\MembreEquipe;
use App\Repository\MembreEquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     */
    public function index(SessionInterface $session): Response
    {
        // dd($session->get('actif'));

        if( $session->get('actif')){  
            return $this->render('home/home.html.twig');
        }else{
            $session->set('actif', '1');
            return $this->render('home/popup.html.twig');
        }
    }

    /**
     * @Route("/soins", name="Soins")
     */
    public function soins(): Response
    {
        return $this->render('home/soins.html.twig');
    }


    /**
     * @Route("/equipe", name="Equipe")
     */
    public function equipe(MembreEquipeRepository $membreEquipeRepository): Response
    {

     
        return $this->render('home/equipe.html.twig',
        [
            'membre_equipe_home' => $membreEquipeRepository->findAll(),
            ]);
        }
    
    


    /**
     * @Route("/clinique", name="Clinique")
     */
    public function clinique(MembreEquipeRepository $membreEquipeRepository): Response
    {

     
        return $this->render('home/clinique.html.twig',
        [
            'membre_equipe_home' => $membreEquipeRepository->findAll(),
            ]);
        }
    



    /**
     * @Route("/rendez_vous", name="Rendez_vous")
     */
    public function rendezVous(): Response
    {
        return $this->render('home/rendez_vous.html.twig');
    }
}

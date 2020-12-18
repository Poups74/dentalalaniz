<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * 
     */
    public function test(SessionInterface $session): Response
    {
        dd('page de test');
    }

    /**
     * @Route("/", name="pop_up")
     */
    public function index(SessionInterface $session): Response
    {
        return $this->render('home/popup.html.twig');
    }
    

    /**
     * @Route("/home", name="Home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/clinique", name="Clinique")
     */
    public function clinique(): Response
    {
        return $this->render('home/clinique.html.twig');
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
    public function equipe(): Response
    {
        return $this->render('home/equipe.html.twig');
    }
    /**
     * @Route("/rendez_vous", name="Rendez_vous")
     */
    public function rendezVous(): Response
    {
        return $this->render('home/rendez_vous.html.twig');
    }
}

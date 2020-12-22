<?php

namespace App\Controller;

use App\Form\PatientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="Home")
     */
    public function index(SessionInterface $session): Response
    {
        if( $session->get('actif') ){
            return $this->render('home/home.html.twig');
        }else{
            $session->set('actif', '1');
            return $this->render('home/popup.html.twig');
        }
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
    public function rendezVous(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(PatientFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $manager->persist($patient);
            $manager->flush();

        }

        return $this->render('home/rendez_vous.html.twig',[
            'patient_form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     */
    public function index(): Response
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
    public function rendezVous(Request $request, EntityManagerInterface $manager): Response
    {
        // 1. Créer le formulaire
        $form = $this->createForm(PatientFormType::class);
        // 2. Passage de la requête au formulaire (récupération des données POST, validation)
        $form->handleRequest($request);

        // 3. Vérifier si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // 4. Récupérer les données de formulaire
            $patient = $form->getData();

            // Enregistrement en base de données
            $manager->persist($patient);
            $manager->flush();
        }

        return $this->render('home/rendez_vous.html.twig',[
            'patient'=>$patient
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\PatientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\MembreEquipe;
use App\Repository\MembreEquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     */
    public function index(SessionInterface $session, Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $formHome = $this->createForm(PatientFormType::class);
        $formHome->handleRequest($request);

        if ($formHome->isSubmitted() && $formHome->isValid()) {
            $patientHome = $formHome->getData();
            $motif = $formHome->get('MotifConsultation')->getData();
            $message = $formHome->get('message')->getData();
            // dd($patient);
            


            $message = (new TemplatedEmail())
                // On attribue l'expéditeur
                ->from('noreply@jacquot-sebastien.fr')
                // On attribue le destinataire
                ->to('tooky972mada@gmail.com')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'patient'=>$patientHome,
                    'motif'=> $motif,
                    'message'=>$message
                    ])
                
            ;
            $mailer->send($message);


            $manager->persist($patientHome);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');
            $manager->flush();
        }

        if ($session->get('actif')) {
            return $this->render('home/home.html.twig', [
                'patient' => $formHome->createView()
            ]);
        } else {
            $session->set('actif', '1');
            return $this->render('home/popup.html.twig', [
                'patient' => $formHome->createView()
            ]);
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
        return $this->render(
            'home/equipe.html.twig',
            [
            'membre_equipe_home' => $membreEquipeRepository->findAll(),
            ]
        );
    }

    



    /**
     * @Route("/rendez_vous", name="Rendez_vous")
     */
    public function rendezVous(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {

        $form = $this->createForm(PatientFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();
            $motif = $form->get('MotifConsultation')->getData();
            $message = $form->get('message')->getData();
            // dd($patient);
            


            $message = (new TemplatedEmail())
                // On attribue l'expéditeur
                ->from('noreply@jacquot-sebastien.fr')
                // On attribue le destinataire
                ->to()
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'patient'=>$patient,
                    'motif'=> $motif,
                    'message'=>$message
                    ])
                
            ;
            $mailer->send($message);


            $manager->persist($patient);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');
            $manager->flush();
        }
        return $this->render('home/rendez_vous.html.twig', [
            'patient_form' => $form->createView()
        ]);
    }


        
/**
*  @Route("/clinique", name="Clinique")     
*/
    public function clinique(MembreEquipeRepository $membreEquipeRepository): Response 
    {             
        return $this->render('home/clinique.html.twig', [            
            'membre_equipe_home' => $membreEquipeRepository->findAll()
        ]);        
    }



 
}

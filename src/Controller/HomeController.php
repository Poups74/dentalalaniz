<?php

namespace App\Controller;

use App\Form\PatientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\MembreEquipe;
use App\Repository\MembreEquipeRepository;
use App\Repository\PatientRepository;
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
    public function index(SessionInterface $session, Request $request, EntityManagerInterface $manager, MailerInterface $mailer, PatientRepository $patientRepository): Response
    {
        $formHome = $this->createForm(PatientFormType::class,null,['medecin' => false]);
        $formHome->handleRequest($request);

        if ($formHome->isSubmitted() && $formHome->isValid()) {
            $patientHome = $formHome->getData();
            $motif = $formHome->get('MotifConsultation')->getData();
            $message = $formHome->get('message')->getData();
            // dd($patient);
            


            $email = (new TemplatedEmail())
                // On attribue l'expéditeur
                ->from('noreply@jacquot-sebastien.fr')
                // On attribue le destinataire
                ->to('diaphrvbdev@gmail.com')
                ->htmlTemplate('emails/contact.html.twig')
                ->subject('Demande de Renseignements')
                ->context([
                    'patient'=>$patientHome,
                    'motif'=>$motif,
                    'message'=>$message
                    ])
                
            ;
            $mailer->send($email);

            // controle de l'exostence ou nom du patient dans la base de données 
            // Si un patient existe dans la base avec le même email que celui soumis dans le formulaire, alors 
            // le patient n'est pas inséré dans la base de données
            $emailPatientHome= $formHome->get('email')->getData();
            $isPatient = $patientRepository->findOneBy(['email' => $emailPatientHome]);
            if (!$isPatient){
       

            $manager->persist($patientHome);
             }

            $this->addFlash('info', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');
            $manager->flush();
        }

        if ( $session->get('actif') ) {
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
    public function rendezVous(Request $request, EntityManagerInterface $manager, MailerInterface $mailer, PatientRepository $patientRepository ): Response
    {

        $form = $this->createForm(PatientFormType::class);
        // dd($form);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $motif = $form->get('MotifConsultation')->getData();
            $messagePatient =$form->get('message')->getData();
            $medecin= $form->get('SelectMedecin')->getData();
        //   dd($motif);
            


            $email = (new TemplatedEmail())
                // On attribue l'expéditeur
                ->from('noreply@jacquot-sebastien.fr')
                // On attribue le destinataire
                ->to('diaphrvbdev@gmail.com')
                ->htmlTemplate('emails/contact.html.twig')
                ->subject('Demande de Rendez-vous')
                ->context([
                    'medecin'=>$medecin,
                    'patient'=>$patient,
                    'motif'=>$motif,
                    'message'=>$messagePatient
                    ])
                
            ;
            // dd($message);
            $mailer->send($email);
            
            // controle de l'exostence ou nom du patient dans la base de données 
            // Si un patient existe dans la base avec le même email que celui soumis dans le formulaire, alors 
            // le patient n'est pas inséré dans la base de données
            $emailPatient=$form->get('email')->getData();
            $isPatient = $patientRepository->findOneBy(['email' => $emailPatient]);
            if (!$isPatient){
            $manager->persist($patient);
             }

            $this->addFlash('info', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');
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



   /**
*  @Route("/listeSelect", name="Select")     
*/
    public function listeSelect(MembreEquipeRepository $membreEquipeRepository): Response 
    {             
        return $this->render('Home/_listeSelect.html.twig', [            
            'membre_equipe_Select' => $membreEquipeRepository->findAll()
        ]);        
    }

    /**
     * @Route("/mentions_legales", name="Mentions_legales")
     */
    public function mentionsLegales(): Response
    {
        return $this->render('home/mentions_legales.html.twig');
    }

    /**
     * @Route("/404", name="404")
     */
    public function page_not_found(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }


 
}

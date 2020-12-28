<?php

namespace App\Controller;

use App\Form\InsertAdminType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('Soins');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/ajout", name="ajout_admin")
     */
    public function insert_admin(UserRepository $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) 
    {
        $form = $this->createForm(InsertAdminType::class);
        $form->handleRequest($request);

            if( $form->isSubmitted() && $form->isValid() ){
                // Récuperation des donnees
                $user = $form->getData();

                // Encodage du password
                $password = $user->getPassword();
                $encoded = $encoder->encodePassword($user, $password);

                $user->setPassword($encoded);

                // Définition du Role
                $user->setRoles(['ROLE_ADMIN']);

                // Envoi du formulaire en BDD
                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Nouvel administrateur enregistré');
                return $this->redirectToRoute('app_login');
            }
        
        return $this->render('security/ajoutAdmin.html.twig', [
            'admin_form' => $form->createView()
        ]);
    }
}

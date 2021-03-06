<?php

namespace App\Controller\Admin;

use App\Entity\MembreEquipe;
use App\Form\MembreEquipeFormType;
use App\Repository\MembreEquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ConfirmationFormType;
use App\Service\UploaderService;
use Symfony\Component\HttpFoundation\File\File;

/**
     * ici le nom peut être n'importe lequel (/admin/membres-equipe)!!!!!
     * @Route("/admin/membres-equipe", name="admin_membre_equipe_")
     */

class MembreEquipeController extends AbstractController
{ 
  

    /**
    * @Route("/poup", name="")
    */
    public function index(): Response
    {


        return $this->render('admin/dashboard/membre_equipe.html.twig', [
            'controller_name' => 'MembreEquipeController',
            
        ]);
    }


     /**
     * Liste des membres de l'équipe
     * @Route("/list", name="list")
     */
    public function membreEquipeList(MembreEquipeRepository $membreEquipeRepository)
    {
        return $this->render('admin/dashboard/membre_equipe_list.html.twig', [
            'membre_equipe_list' => $membreEquipeRepository->findAll(),
        ]);
    }



     /**
     * Ajouter un membre dans l'équipe
     * @Route("/add", name="add")
     */
    public function membreEquipeAdd(Request $request, EntityManagerInterface $manager, UploaderService $uploaderService)
    {

 

        // 1. Créer le formulaire
        $form = $this->createForm(MembreEquipeFormType::class);
        // 2. Passage de la requête au formulaire (récupération des données POST, validation)
        $form->handleRequest($request);

        // 3. Vérifier si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {

            $membreEquipe = $form->getData();

            if(file_exists($membreEquipe->getImage()))
            {
            $brochureFile = $form->get('image')->getData();
            $fileName = $uploaderService->saveMembreEquipePhoto($brochureFile);
            // dd( $fileName);
            
            $membreEquipe->setImage($fileName);

           
            $manager->persist($membreEquipe);
            $manager->flush();

            // Ajout d'un message flash
            $this->addFlash('success', 'Le nouveau membre a été enregistré.');
            }


            else{


                $image = new File($this->getParameter('kernel.project_dir').'/public/images/ocean.png');
                // dd($image);
                $membreEquipe->setImage( $image);
                $fileName = $uploaderService->saveMembreEquipePhoto($image);
                // dd( $fileName);
                $membreEquipe->setImage($fileName);
                $manager->persist($membreEquipe);
                $manager->flush();
                  // Ajout d'un message flash
                $this->addFlash('success', 'Le nouveau membre a été enregistré.');

            
            }
            
            // dd($file);

            // return $this->redirectToRoute('admin_membre_equipe_edit', ['id' => $membreEquipe->getId()]);
        }

        // On envoit une "vue de formulaire" au template
        return $this->render('admin/dashboard/membre_equipe_add.html.twig', [
            'membreEquipe_form' => $form->createView(),
        ]);
    }



     /**
     * Modification d'un artiste
     * @Route("/{id}/edit", name="edit")
     */
    public function membreEquipeEdit(MembreEquipe $membreEquipe, Request $request, EntityManagerInterface $manager, UploaderService $uploaderService)
    {
        // On passe l'entité à modifier au formulaire
        // Il sera pré-rempli, et l'entité sera automatiquement modifiée

        $form = $this->createForm(MembreEquipeFormType::class, $membreEquipe);
        $form->handleRequest($request);

       
        if(file_exists($membreEquipe->getImage()))
        {
            
        $brochureFile = $form->get('image')->getData();
        // dd($brochureFile);
        $fileName = $uploaderService->saveMembreEquipePhoto($brochureFile);
        // dd( $fileName);
        
        $membreEquipe->setImage($fileName);

        }

        // $membreEquipe->setImage(
        //     new File($this->getParameter('kernel.project_dir').'/public/images/'.$membreEquipe->getImage())
        // );
        // dd($membreEquipe->getImage());

        

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager
            $manager->flush();
            $this->addFlash('success', 'Le membre d\'equipe a été mis à jour.');
        }

        return $this->render('admin/dashboard/membre_equipe_edit.html.twig', [
            'membre_equipe' => $membreEquipe,
            'membreEquipe_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function artistDelete( MembreEquipe $membreEquipe, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $manager->remove($membreEquipe);
          $manager->flush();
          $this->addFlash('intro', sprintf('Le membre a bien été supprimé.',$membreEquipe->getNom()));
          return $this->redirectToRoute('admin_membre_equipe_list');
        }

        return $this->render('admin/dashboard/membre_equipe_delete.html.twig', [
            'membre_equipe' => $membreEquipe,
            'confirmation_form' => $form->createView(),
        ]);
    }
}

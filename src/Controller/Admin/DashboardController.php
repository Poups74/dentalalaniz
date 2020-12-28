<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use App\Form\ConfirmationFormType;
use App\Form\PatientFormType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


    
class DashboardController extends AbstractController
{
   /**
     * @Route("/admin", name="admin_")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

      /**
     * Liste des patients
     * @Route("/patient", name="patient_list")
     */
    public function patientList(PatientRepository $patientRepository)
    {
        return $this->render('admin/dashboard/patient_list.html.twig', [
            'patient_list' => $patientRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un patient
     * @Route("/patient/new", name="patient_add")
     */
    public function patientAdd(Request $request, EntityManagerInterface $manager)
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

            // Ajout d'un message flash
            $this->addFlash('success', 'Le nouveau patient a été enregistré.');
            return $this->redirectToRoute('admin_patient_edit', ['id' => $patient->getId()]);
        }

        // On envoit une "vue de formulaire" au template
        return $this->render('admin/dashboard/patient_add.html.twig', [
            'patient_form' => $form->createView()
        ]);
    }

    /**
     * Modification d'un patient
     * @Route("/patient/{id}/edit", name="patient_edit")
     */
    public function patientEdit(Patient $patient, Request $request, EntityManagerInterface $manager)
    {
        // On passe l'entité à modifier au formulaire
        // Il sera pré-rempli, et l'entité sera automatiquement modifiée
        $form = $this->createForm(PatientFormType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager
            $manager->flush();
            $this->addFlash('success', 'Le patient a été mis à jour.');
        }

        return $this->render('admin/dashboard/patient_edit.html.twig', [
            'patient' => $patient,
            'patient_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/patient/{id}/delete", name="patient_delete")
     */
    public function patientDelete(Patient $patient, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($patient);
            $manager->flush();

            $this->addFlash('info', sprintf('Le patient "%" a bien été supprimé.', $patient->getNom()));
            return $this->redirectToRoute('patient_list');
        }

        return $this->render('admin/dashboard/patient_delete.html.twig', [
            'patient' => $patient,
            'confirmation_form' => $form->createView(),
        ]);
    }
    
}

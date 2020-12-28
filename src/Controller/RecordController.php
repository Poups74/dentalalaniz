<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{

    /**
     * Page d'un patient
     * @Route("/patient/{id<\d+>}", name="patient_page")
     */
    public function patientPage(): Response
    {
        return $this->render(
            'record/patient_page.html.twig',[
                'variable_test'=> 'Informations Patient'
            ]
        );
}

    /**
     * Liste des consultations
     * @Route("/consult_list/{id<\d+>}", name="consult_list")
     */
    public function consultList(): Response
    {
        return $this->render(
            'record/consult_list.html.twig',[
                'variable_test'=> 'Liste des conultations'
            ]
        );
}
        
    /**
     * Page d'une consultation
     * @Route("/consult/{id<\d+>}", name="consult_page")
     */
    public function consultPage(): Response
    {
        return $this->render(
            'record/consult_page.html.twig',[
                'variable_test'=> 'Detail Consultation'
            ]
        );
    }
}


 

<?php

namespace App\Form;

use App\Entity\Patient;
use App\Repository\MembreEquipeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PatientFormType extends AbstractType
{
    private $medecin ;


    public function __construct( MembreEquipeRepository  $medecin)
    {
       $this->medecin=$medecin ;
       
    }


    public function buildForm(FormBuilderInterface $builder, array $options )
    {

        $liste= $this->medecin->findAll();
        $array = [];
        foreach ($liste as $category) {
            if (!empty($category->getNom())) {
              
                $array[$category->getTitre().' '.$category->getPrenom().' '.$category->getNom()] = $category->getTitre().' '.$category->getPrenom() 
                .' '.$category->getNom() ;
                
                // dd($array);
                
                // dd($array);
           
               
            }
        }

        $builder->add('SelectMedecin', ChoiceType::class, array(
                            'choices' => $array,
<<<<<<< HEAD
=======
                            'data_class' => null,
>>>>>>> RV
                            'mapped'=> false))



<<<<<<< HEAD
            ->add('nom',TextType::class, [
=======
            ->add('Nom',TextType::class, [
>>>>>>> RV
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est manquant.']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'maxMessage' => 'Le nom ne peut comporter plus de {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('prenom',TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom est manquant.']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'maxMessage' => 'Le prénom ne peut comporter plus de {{ limit }} caractères.'
                    ])
                ]
            ])
<<<<<<< HEAD
            ->add('telephone',TelType::class)
            ->add('email', EmailType::class)
=======
            ->add('Telephone',TelType::class)
            ->add('Email', EmailType::class)
>>>>>>> RV
            ->add('civilite', ChoiceType::class,[
                'choices'=>[
                    'femme'=>'f',
                    'homme'=>'h'
                ],
                'expanded'=>true
            ])
            ->add('MotifConsultation',TextType::class,[
<<<<<<< HEAD
                'mapped'=>false
            ] )
            ->add('message', TextareaType::class,[
                'mapped'=>false
=======
                'mapped'=>false,
                'data_class' => null
            ] )
            ->add('message', TextareaType::class,[
                'mapped'=>false,
                'data_class' => null
>>>>>>> RV
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}

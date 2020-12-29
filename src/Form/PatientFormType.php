<?php

namespace App\Form;

use App\Entity\MembreEquipe;
use App\Entity\Patient;
use App\Repository\MembreEquipeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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


    public function buildForm(FormBuilderInterface $builder, array $options )
    {
            
        
        if($options['medecin']===true) {

            $builder->add('SelectMedecin', EntityType::class, array(
                'class' => MembreEquipe::class,
                'mapped'=> false,
                'choice_label'=> function(MembreEquipe $membreEquipe) {

                    return $membreEquipe->getTitre().' '.$membreEquipe->getPrenom().' '.$membreEquipe->getNom();

                    }
                )
            );



        }


        if($options['saisiePatient']===true) {

            $builder->add('MotifConsultation',TextType::class,[
                'mapped'=>false,
                'data_class' => null
            ] )
            ->add('message', TextareaType::class,[
                'mapped'=>false,
                'data_class' => null
            ])
            
            ;

        }
       

        $builder->add('nom',TextType::class, [
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

            
            ->add('telephone',TelType::class)
            ->add('email', EmailType::class)
            ->add('civilite', ChoiceType::class,[
                'choices'=>[
                    'femme'=>'f',
                    'homme'=>'h'
                ],
                'expanded'=>true
            ])
           
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'medecin'=> true,
            'saisiePatient'=> true,
            'data_class' => Patient::class,
        ]);
    }
}
